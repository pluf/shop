<?php
Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Pluf_Shortcuts_GetRequestParamOr403');
Pluf::loadFunction('Pluf_Shortcuts_GetRequestParam');

/**
 * مدیریت عملیات مربوط به سفارشات (شامل چرخه حیات و همچنین کنترل دسترسی) را بر
 * عهده دارد
 *
 * @author hadi<mohammad.hadi.mansouri@dpq.co.ir>
 *        
 */
class Shop_Order_Manager_Default implements Shop_Order_Manager
{
    /**
     * State machine of the manager
     */
    public static $STATE_MACHINE = array(
            Workflow_Machine::STATE_UNDEFINED => array(
                    'next' => 'Locked'
            ),
            // State
            'Locked' => array(
                    // Transaction or event
                    'pay' => array(
                            'next' => 'Unlocked',
                            'visible' => true
                    ),
                    'update' => array(
                            'next' => 'Locked',
                            'visible' => false
                    ),
                    'read' => array(
                            'next' => 'Locked',
                            'visible' => false
                    ),
                    'delete' => array(
                            'next' => 'Deleted',
                            'visible' => false
                    )
            ),
            'Unlocked' => array(
                    // Transaction or event
                    'read' => array(
                            'next' => 'Unlocked',
                            'visible' => false
                    ),
                    'delete' => array(
                            'next' => 'Deleted',
                            'visible' => false
                    )
            ),
            'Deleted' => array()
    );

    /**
     * Filter of orders
     * 
     * Creates a filter to find the list which are accissable by user.
     * 
     * هر کاربر بر اساس درخواست ورودی می‌تواند دسته‌ای از سفارشات را مشاهده
     * کند. این فراخونی بر اساس درخواست کاربر یک عبارت منطقی برای فیلتر کردن
     * سفارشات ایجاد می‌کند.
     *
     * @param Pluf_HTTP_Request $request
     * @return Pluf_SQL
     */
    public function createOrderFilter ($request)
    {
        // افرادی که عضو نیستن هیچی نمی‌بینن
        if (! Pluf_Precondition::isAuthorized($request)) {
            return new Pluf_SQL('false');
        }
        
        // عبارت پیش فرض
        $sql = new Pluf_SQL('deleted=false');
        
        // مالک همه چیز رو داره
        if (Pluf_Precondition::isOwner($request)) {
            return $sql;
        }
        
        // // CRM
        // if ($request->user->hasPerm('Shop.crm')) {
        // // $sql->SAnd(new Pluf_SQL('state="new" OR state="close"'));
        // return $sql;
        // }
        
        $sqlIn = new Pluf_SQL('customer=%s',
                array(
                        $request->user->id
                ));
        
        // Zone Owner
        if ($request->user->hasPerm('Shop.zoneOwner')) {
            $zones = (new Shop_Zone())->getList(
                    array(
                            'filter' => 'owner=' . $request->user->getId()
                    ));
            $conditions = array();
            foreach ($zones as $z) {
                array_push($conditions, 'zone=' . $z->getId());
            }
            $conditions = implode(' OR ', $conditions);
            $sqlNew = new Pluf_SQL($conditions);
            // $sql->SAnd(new Pluf_SQL('state="check" OR state="fixed" OR
            // state="fail"'));
            $sqlNew->SAnd(
                    new Pluf_SQL(
                            'state<>"new" AND state<>"close" AND state<>"archived"'));
            
            $sqlIn->SOr($sqlNew);
        }
        
        // // Digitechs
        // if ($request->user->hasPerm('Shop.digitech')) {
        // $sqlNew = new Pluf_SQL('responsible=%s', array(
        // $request->user->id
        // ));
        // $sqlNew->SAnd(new Pluf_SQL('state="waiting" OR state="schedule"'));
        
        // $sqlIn->SOr($sqlNew);
        // }
        
        // Agency
        if ($request->user->hasPerm('Shop.agency')) {
            $agencys = (new Shop_Agency())->getList(
                    array(
                            'filter' => 'owner=' . $request->user->getId()
                    ));
            $conditions = array();
            foreach ($agencys as $ws) {
                array_push($conditions, 'agency=' . $ws->getId());
            }
            $conditions = implode('OR', $conditions);
            $sqlNew = new Pluf_SQL($conditions);
            // $sql->SAnd(new Pluf_SQL('state="agency-check" OR
            // state="in-queue" OR state="repairing" OR state="giving_back"'));
            $sqlNew->SAnd(new Pluf_SQL('state<>"close" AND state<>"archive"'));
            
            $sqlIn->SOr($sqlNew);
        }
        
        $sql->SAnd($sqlIn);
        return $sql;
    }

//     /**
//      *
//      * @param Pluf_HTTP_Request $request
//      * @param Shop_Order $order
//      * @return boolean|unknown
//      */
//     public static function canAccess ($request, $order)
//     {
//         // Admin has access to all objects
//         if ($request->user->administrator) {
//             return true;
//         }
//         // Owner has access to all his/her objects
//         if (Pluf_Precondition::isOwner($request)) {
//             return true;
//         }
//         // ZoneOwner has access to all orders in the its zones
//         if ($request->user->hasPerm('Shop.zoneOwner')) {
//             // Check if request is in related zone
//             if (isset($order->zone) &&
//                      $order->get_zone()->owner === $request->user->id)
//                 return true;
//         }
//         // AgencyOwner has access to all orders in the its agency
//         if ($request->user->hasPerm('Shop.agency')) {
//             if (isset($order->agency) &&
//                      $order->get_agency()->owner === $request->user->id)
//                 return true;
//         }
//         // Responsible of a request has access to request
//         if ($order->responsible != null &&
//                  $order->responsible === $request->user->id)
//             return true;
//         // Customer has access to all its requests
//         if ($order->customer != null && $order->customer === $request->user->id)
//             return true;
//         return false;
//     }

    /**
     * یک عمل در چرخه حیاط درخواست انجام می‌شود.
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     */
    public function apply ($object, $action)
    {
        $machine = new Workflow_Machine();
        $machine->setStates(self::STATE_MACHINE)
            ->setSignals(
                array(
                        'Shot_Order::stateChange'
                ))
            ->setProperty('state')
            ->apply($object, $action);
        return true;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see Shop_Order_Manager::nextStates()
     */
    public function nextStates($order){
        $states = array();
        foreach (self::$STATE_MACHINE[$order->state] as $id => $state){
            $state['id'] = $id;
            $states[] = $state;
        }
        return $states;
    }

//     /**
//      *
//      * @param Pluf_HTTP_Request $request
//      * @param Shop_Zone $zone
//      * @return boolean
//      */
//     public static function isZoneOwner ($request, $zone)
//     {
//         if (Pluf_Precondition::isOwner($request))
//             return true;
//         return $request->user->hasPerm('Shop.zoneOwner') &&
//                  $zone->isOwner($request->user);
//     }

//     /**
//      *
//      * @param unknown $request
//      * @param Shop_Agency $agency
//      * @return boolean
//      */
//     public static function isAgencyOwner ($request, $agency)
//     {
//         if (Pluf_Precondition::isOwner($request))
//             return true;
//         return $request->user->hasPerm('Shop.agencyOwner') &&
//                  $agency->isOwner($request->user);
//     }

//     /**
//      * کارگاه را برای یک درخواست تعیین می‌کند
//      *
//      * با تعیین شدن کارگاه برای یک درخواست، مالک کارگاه می‌تونه درخواست رو در
//      * فهرست درخواست‌های خودش مشاهده کنه.
//      *
//      * @param unknown $request
//      * @param unknown $match
//      */
//     public static function setAgency ($request, $object)
//     {}

//     public static function setZone ($request, $object)
//     {}

//     /**
//      * درخواست داده شده را به حالت بسته شده می‌برد.
//      * نحوه بسته شدن درخواست که همان آخرین وضعیت درخواست قبل از بسته شدن است را
//      * می‌توان به عنوان پارامتر ورودی داد.
//      * در صورتی که این مقدار تعیین نشود به صورت پیش‌فرض اخرین وضعیت درخواست قبل
//      * از بسته شدن به عنوان
//      * حالت نهایی درخواست ثبت می شود
//      * از پارامتر $action نیز برای ثبت تاریخچه استفاده می‌شود
//      *
//      * @param Pluf_HTTP_Request $request
//      * @param Pluf_Model $object
//      */
//     public static function close ($request, $object)
//     {}
}