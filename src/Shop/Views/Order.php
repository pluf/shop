<?php
Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');

class Shop_Views_Order
{

    /**
     * یک تقاضای جدید در سیستم ایجاد می‌کند.
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @return Pluf_HTTP_Response_Json
     */
    public static function create($request, $match)
    {
        $user = $request->user;
        $data = $request->REQUEST;
        if (isset($user)) {
            $request->REQUEST['full_name'] = isset($data['full_name']) ? $data['full_name'] : $user->first_name . ' ' . $user->last_name;
            $request->REQUEST['email'] = isset($data['email']) ? $data['email'] : $user->email;
            // TODO: hadi: get phone number from profile and set it if already is not set.
        }
        $form = Pluf_Shortcuts_GetFormForModel(Pluf::factory('Shop_Order'), $request->REQUEST);
        $order = $form->save();
        if (isset($user)) {
            $order->__set('customer', $user);
        }
        $order->update();
        
        $match['orderId'] = $order->id;
        $match['action'] = 'create';
        $manager = $order->getManager();
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
        $manager = $order->getManager();
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
        $pag->setFromRequest($request);
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
        self::checkAccess($request, $myOrder);
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
        if ($myOrder->deleted) {
            throw new Pluf_HTTP_Error404("Order is deleted");
        }
        // $manager = Pluf::factory($myOrder->getManager());
        // if (! $manager->canAccess($request, $myOrder)) {
        // throw new Pluf_Exception("You are not allowed to access to this order.");
        // }
        
        $form = Pluf_Shortcuts_GetFormForUpdateModel($myOrder, $request->REQUEST);
        $myOrder = $form->save();
        
        $match['orderId'] = $myOrder->id;
        $match['action'] = 'update';
        $manager = $myOrder->getManager();
        $manager->run($request, $match);
        
        return new Pluf_HTTP_Response_Json($myOrder);
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
        $myOrder = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
        // $manager = Pluf::factory($myOrder->getManager());
        // if (! $manager->canAccess($request, $myOrder)) {
        // throw new Pluf_Exception("You are not allowed to access to this order.");
        // }
        
        if($myOrder->isPayed()){
            throw new Pluf_Exception_PermissionDenied('Could not deletea an already payed order');
        }
        
        $myOrder->deleted = true;
        $myOrder->update();
        
        $match['orderId'] = $myOrder->id;
        $match['action'] = 'delete';
        $manager = $myOrder->getManager();
        $manager->run($request, $match);
        
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
         * @var Shop_Order $order
         */
        $order = null;
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
            $user = $request->user;
            // Note: Hadi - 1396-05-06: only customer of order could add item to its order.
            if (! isset($user) || $user->id !== $order->customer) {
                return new Pluf_Exception_Unauthorized('You are not allowed to do this action.');
            }
        }
        
        if($order->isPayed()){
            throw new Pluf_Exception_PermissionDenied('Could not pay again for an already payed order');
        }
        
        $user = $request->user;
        $url = $request->REQUEST['callback'];
        $backend = $request->REQUEST['backend'];
        $price = $order->computeTotalPrice();
        
        $receiptData = array(
            'amount' => $price, // مقدار پرداخت به تومان
            'title' => $order->id . ' - ' . $order->title,
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

    public static function payInfo($request, $match){
        /**
         * @var Shop_Order $order
         */
        $order = null;
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
            self::checkAccess($request, $order);
        }
        self::checkPay($request, $match);
        $receipt = $order->get_payment();
        if($receipt == null){
            return new Pluf_HTTP_Error404('Could not found payment');
        }
        return new Pluf_HTTP_Response_Json($receipt);
    }
    
    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     */
    public static function checkPay($request, $match)
    {
        $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
        $payed = self::updateReceiptInfo($order);
        return new Pluf_HTTP_Response_Json($payed);
    }

    /**
     * Checks receipt info and returns true if receipt is payed and false otherwise.
     * @param Shop_Order $order
     * @return boolean
     */
    private static function updateReceiptInfo($order)
    {
        if (! $order->payment) {
            return false;
        }
        $receipt = $order->get_payment();
        Bank_Service::update($receipt);
        return $order->get_payment()->isPayed();
    }

    // ***********************************************************
    // Deliver
    // **********************************************************
    
    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @return Pluf_HTTP_Response_Json
     */
    public static function setDeliverType($request, $match)
    {
        /**
         * @var Shop_Order $order
         */
        $order = null;
        if (isset($match['secureId'])) {
            $order = Shop_Views_Order::getOrderBySecureId($match['secureId']);
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
            self::checkAccess($request, $order);
        }
        
        if ($order->isPayed()) {
            throw new Pluf_Exception_PermissionDenied('Could not change an already payed order');
        }
        
        $deliver = Pluf_Shortcuts_GetObjectOr404('Shop_DeliverType', $match['deliverId']);
        $order->__set('deliver_type', $deliver);
        // Remove payment because it is not valid yet.
        // TODO: Hadi 1396-05: remove related receipt / or uupdate receipt info instead of remove it
        $order->invalidatePayment();
        $order->update();
        return new Pluf_HTTP_Response_Json($order);
    }

    // ***********************************************************
    // Workflow
    // **********************************************************
    public static function actions($request, $match)
    {
        if (isset($match['secureId'])) {
            $order = Shop_Views_Order::getOrderBySecureId($match['secureId']);
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
            self::checkAccess($request, $order);
        }
        $manager = $order->getManager();
        // TODO: hadi: complete code. I think it should be similar to followin codes.
        // $wf = $manager->getWorkflow();
        // $actions = $wf->nextStates();
        $actions = array(
            'reject',
            'accept',
            'cancel',
            'close'
        );
        return new Pluf_HTTP_Response_Json($actions);
    }

    public static function act($request, $match)
    {
        if (isset($match['secureId'])) {
            $order = Shop_Views_Order::getOrderBySecureId($match['secureId']);
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
            self::checkAccess($request, $order);
        }
        $action = $match['action'];
        $manager = $order->getManager();
        // TODO: hadi: complete code. I think it should be similar to followin codes.
        // $wf = $manager->getWorkflow();
        // $actions = $wf->act($order, $action);
        return new Pluf_HTTP_Response_Json($action);
    }
}