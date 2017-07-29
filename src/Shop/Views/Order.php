<?php
Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');

class Shop_Views_Order
{

    /**
     * یک تقاضای جدید در سیستم ایجاد می‌کند.
     *
     * @param unknown $request            
     * @param unknown $match            
     * @return Pluf_HTTP_Response_Json
     */
    public static function create($request, $match)
    {
        $extra = array(
            'user' => $request->user
        );
        $form = new Shop_Form_OrderCreate($request->REQUEST, $extra);
        $order = $form->save();
        $match['orderId'] = $order->id;
        $match['action'] = 'create';
        $manager = Pluf::factory($order->getManager());
        $manager->run($request, $match);
        return new Pluf_HTTP_Response_Json(array_merge($order->jsonSerialize(), array(
            'secureId' => $order->secureId
        )));
    }

    /**
     * فهرست کردن تقاضا‌های موجود
     *
     * @param Pluf_HTTP_Order $request            
     * @param array $match            
     * @return Pluf_HTTP_Response_Json
     */
    public static function find($request, $match)
    {
        $order = new Shop_Order();
        $pag = new Pluf_Paginator($order);
        // TODO: hadi: use sqlgenerator
        $manager = Pluf::factory($order->getManager());
        $pag->forced_where = $manager->createOrderFilter($request);
        $pag->list_filters = array(
            'phone',
            'email',
            'province',
            'city',
            'point',
            'state',
            'customer',
            'deliver_type',
            'zone',
            'agency'
        );
        $search_fields = array(
            'title',
            'full_name',
            'phone',
            'email',
            'province',
            'city',
            'address',
            'description'
        );
        $sort_fields = array(
            'id',
            'full_name',
            'province',
            'city',
            'state',
            'state',
            'deliver_type',
            'zone',
            'agency',
            'creation_date',
            'modif_dtime'
        );
        // NOTE: maso, 1395: User app are responsible to get more items
        $pag->items_per_page = Shop_Shortcuts_NormalizeItemPerPage($request);
        $pag->configure(array(), $search_fields, $sort_fields);
        $pag->setFromOrder($request);
        return new Pluf_HTTP_Response_Json($pag->render_object());
    }

    /**
     * یک درخواست را با شناسه تعیین می‌کند
     *
     * @param unknown $request            
     * @param unknown $match            
     * @return Pluf_HTTP_Response_Json
     */
    public static function get($request, $match)
    {
        $myOrder = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
        Shop_Views_Order::checkAccess($request, $myOrder);
        // اجرای درخواست
        return new Pluf_HTTP_Response_Json($myOrder);
    }

    /**
     * دسترسی امن به داده‌ها
     *
     * توی این فراخوانی دسترسی‌های امنیتی بررسی نمی‌شوند.
     *
     * @param unknown $request            
     * @param unknown $match            
     * @throws Pluf_Exception_DoesNotExist
     * @return Pluf_HTTP_Response_Json
     */
    public static function getBySecureId($request, $match)
    {
        $myOrder = Shop_Views_Order::getOrderBySecureId($match['secureId']);
        // اجرای درخواست
        return new Pluf_HTTP_Response_Json(array_merge($myOrder->jsonSerialize(), array(
            'secureId' => $match['secureId']
        )));
    }

    /**
     * Returns a Shop_Order with given secureId
     *
     * @param string $secureId            
     * @throws Pluf_Exception_DoesNotExist
     * @return Shop_Order
     */
    public static function getOrderBySecureId($secureId)
    {
        $myOrder = new Shop_Order();
        $order = $myOrder->getOne("secureId='" . $secureId . "'");
        // TODO: hadi: check following also
        // $list = $myOrder->getOne("secureId='$secureId'");
        return $order;
    }

    /**
     * درخواست را به روز می‌کند
     *
     * @param unknown $request            
     * @param unknown $match            
     */
    public static function update($request, $match)
    {
        $myOrder = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
        // $manager = Pluf::factory($myOrder->getManager());
        // if (! $manager->canAccess($request, $myOrder)) {
        // throw new Pluf_Exception("You are not allowed to access to this order.");
        // }
        $form = Pluf_Shortcuts_GetFormForModel($myOrder, $request->REQUEST);
        return new Pluf_HTTP_Response_Json($form->save());
    }

    /**
     * درخواست را حذف می‌کند.
     *
     * @param unknown $request            
     * @param unknown $match            
     * @return Pluf_HTTP_Response_Json
     */
    public static function delete($request, $match)
    {
        $myOrder = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['requestId']);
        // $manager = Pluf::factory($myOrder->getManager());
        // if (! $manager->canAccess($request, $myOrder)) {
        // throw new Pluf_Exception("You are not allowed to access to this order.");
        // }
        $myOrder->deleted = true;
        $myOrder->update();
        return new Pluf_HTTP_Response_Json($myOrder);
    }

    /**
     * Checks access to given order.
     * If request has not access to order it throws an exception.
     *
     * @param Pluf_HTTP_Request $request            
     * @param Shop_Order $order            
     * @throws Pluf_Exception
     * @return boolean
     */
    public static function checkAccess($request, $order)
    {
        $manager = Pluf::factory($order->getManager());
        if (! $manager->canAccess($request, $order)) {
            throw new Pluf_Exception("You are not allowed to access to this order.");
        }
        return true;
    }

    // ***********************************************************
    // Payment
    // **********************************************************
    
    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     */
    public static function pay($request, $match)
    {
        /**
         *
         * @var Shop_Order $order
         */
        $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
        
        $user = $request->user;
        $url = $request->REQUEST['callback'];
        $backend = $request->REQUEST['backend'];
        $price = $order->computeTotalPrice();
        
        $receiptData = array(
            'amount' => $price, // مقدار پرداخت به تومان
            'title' => $order->title,
            'description' => $order->id . ' - ' . $order->title,
            'email' => $user->email,
            // 'phone' => $user->phone,
            'phone' => '',
            'callbackURL' => $url,
            'backend' => $backend
        );
        
        $payment = Bank_Service::create($receiptData, 'shop-order', $order->id);
        
        $order->payment = $payment;
        $order->update();
        return new Pluf_HTTP_Response_Json($payment);
    }

    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     */
    public static function checkPay($request, $match)
    {
        $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
        return new Pluf_HTTP_Response_Json($order);
    }

    /**
     * Checks
     * 
     * @param unknown $order            
     * @return Pluf_HTTP_Response_Json|unknown
     */
    private static function updateActivationInfo($order)
    {
        if (! $order->payment) {
            return $order;
        }
        $receipt = $order->get_payment();
        Bank_Service::update($receipt);
        if ($order->get_payment()->isPayed())
            return $order;
    }
}