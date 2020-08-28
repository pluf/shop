<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');

class Shop_Views_Order
{

    /**
     * یک تقاضای جدید در سیستم ایجاد می‌کند.
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return Shop_Order
     */
    public static function create($request, $match)
    {
        $user = $request->user;
        $data = $request->REQUEST;
        if (isset($user)) {
            // fullname
            if(!array_key_exists('full_name', $data)){                
                $profiles = $user->get_profiles_list();
                if($profiles->count() > 0){
                    $fullname = $profiles[0]->first_name . ' ' . $profiles[0]->last_name;
                    $request->REQUEST['full_name'] = $fullname;
                }
            }
            // $request->REQUEST['full_name'] = isset($data['full_name']) ? $data['full_name'] : $user->first_name . ' ' . $user->last_name;
            // $request->REQUEST['email'] = isset($data['email']) ? $data['email'] : $user->email;
            // TODO: hadi: get phone number, full name, and email from profile and set it if already
            // is not set.
        }
        Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');
        $form = Pluf_Shortcuts_GetFormForModel(Pluf::factory('Shop_Order'), $request->REQUEST);
        /**
         *
         * @var Shop_Order $order
         */
        $order = $form->save();
        if (isset($user)) {
            $order->customer_id = $user;
        }
        $order->update();
        $manager = $order->getManager();
        $manager->apply($order, 'create');
        // Reveal secure id at creation time
        $order->_a['cols']['secureId']['readable'] = true;
        return $order;
    }

    /**
     * Lists all requests
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return
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
            'manager',
            'customer_id',
            'zone_id',
            'agency_id'
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
            'zone',
            'agency',
            'creation_dtime',
            'modif_dtime'
        );

        Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');
        // NOTE: maso, 1395: User_Account app are responsible to get more items
        $pag->items_per_page = Shop_Shortcuts_NormalizeItemPerPage($request);
        $pag->configure(array(), $search_fields, $sort_fields);
        $pag->setFromRequest($request);
        return $pag;
    }

    /**
     * یک درخواست را با شناسه تعیین می‌کند
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return Shop_Order
     */
    public static function get($request, $match)
    {
        // Get order
        $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
        // check access
        // self::checkAccess($request, $order);
        if (! Shop_Precondition::canViewOrder($request, $order)) {
            return new Pluf_Exception_Unauthorized('You are not allowed to do this action.');
        }
        return $order;
    }

    /**
     * دسترسی امن به داده‌ها
     *
     * توی این فراخوانی دسترسی‌های امنیتی بررسی نمی‌شوند.
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @throws Pluf_Exception_DoesNotExist
     * @return Shop_Order
     */
    public static function getBySecureId($request, $match)
    {
        $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
        // Reveal secure id
        $order->_a['cols']['secureId']['readable'] = true;
        return $order;
    }

    /**
     * درخواست را به روز می‌کند
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     */
    public function update($request, $match)
    {
        /**
         *
         * @var Shop_Order $myOrder
         */
        $order = null;
        if (array_key_exists('secureId', $match)) {
            Pluf::loadFunction('Shop_Shortcuts_GetObjectBySecureIdOr404');
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
            $request->REQUEST['secureId'] = $match['secureId'];
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
        }
        $order->getManager()->apply($order, 'update');
        $order = new Shop_Order($order->id);
        return $order;
    }

    /**
     * درخواست را حذف می‌کند.
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return Shop_Order
     */
    public static function delete($request, $match)
    {
        $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
        $order->getManager()->apply($order, 'delete');
        return $order;
    }

    /**
     * Checks access to given order.
     * If request has not access to order it throws an exception.
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $order
     * @throws \Pluf\Exception
     * @return boolean
     */
    public static function checkAccess($request, $order)
    {
        $manager = $order->getManager();
        $sql = $manager->createOrderFilter($request)->SAnd(new Pluf_SQL('id=%s', array(
            $order->id
        )));
        if (0 == $order->getCount(array(
            'filter' => $sql->gen()
        ))) {
            throw new \Pluf\Exception("You are not allowed to access to this order.");
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
        $order = null;
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
            if (! Shop_Precondition::canModifyOrder($request, $order)) {
                return new Pluf_Exception_Unauthorized('You are not allowed to do this action.');
            }
        }
        if ($order->isPayed()) {
            throw new Pluf_Exception_PermissionDenied('Could not pay again for an already payed order');
        }
        $url = $request->REQUEST['callback'];
        $backend = Pluf_Shortcuts_GetObjectOr404('Bank_Backend', $request->REQUEST['backend']);
        // Check if currency of backend is compatible with currency of tenant
        $tenantCurrency = Tenant_Service::setting('local.currency');
        Pluf::loadFunction('Bank_Shortcuts_IsCurrenciesCompatible');
        if (! Bank_Shortcuts_IsCurrenciesCompatible($backend->currency, $tenantCurrency)) {
            throw new Pluf_Exception_BadRequest('Invalid payment. ' . //
            'Could not pay through a bank backend with different currency than the tenant currency ' . //
            '[tenant: ' . $tenantCurrency . ', backend: ' . $backend->currency);
        }
        $price = $order->computeTotalPrice();
        if ($price <= 0) {
            throw new Pluf_Exception_BadRequest('Invalid amount: ' . $price);
        }
        Pluf::loadFunction('Bank_Shortcuts_ConvertCurrency');
        $price = Bank_Shortcuts_ConvertCurrency($price, $tenantCurrency, $backend->currency);
        $receiptData = array(
            'amount' => $price,
            'title' => $order->id . ' - ' . $order->title,
            'description' => $order->id . ' - ' . $order->title,
            // 'email' => $user->email,
            // 'phone' => $user->phone,
            'email' => '',
            'phone' => '',
            'callbackURL' => $url,
            'backend_id' => $backend->id
        );
        $payment = Bank_Service::create($receiptData, 'shop-order', $order->id);
        $order->payment_id = $payment;
        $order->update();
        return $payment;
    }

    public static function payInfo($request, $match)
    {
        /**
         *
         * @var Shop_Order $order
         */
        $order = null;
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
            self::checkAccess($request, $order);
        }
        $preState = $order->payment_id != null && $order->get_payment()->isPayed();
        $paid = self::updateReceiptInfo($order);
        if (! $preState && $paid) {
            // Order is payed and it is first time that we inform about it
            $manager = $order->getManager();
            $manager->apply($order, 'pay');
        }
        $pag = new Pluf_Paginator(new Bank_Receipt());
        $pag->forced_where = new Pluf_SQL('id=%s', array(
            $order->payment_id
        ));
        return $pag;
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
        return new $payed();
    }

    /**
     * Checks receipt info and returns true if receipt is payed and false
     * otherwise.
     *
     * @param Shop_Order $order
     * @return boolean
     */
    private static function updateReceiptInfo($order)
    {
        if (! $order->payment_id) {
            return false;
        }
        $receipt = $order->get_payment();
        Bank_Service::update($receipt);
        return $order->get_payment()->isPayed();
    }

    // ***********************************************************
    // Workflow
    // **********************************************************
    /**
     * Gets lit of possible actions
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return array an array of transitions
     */
    public function actions($request, $match)
    {
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
            self::checkAccess($request, $order);
        }
        $items = $order->getManager()->transitions($order);
        $page = array(
            'items' => $items,
            'counts' => count($items),
            'current_page' => 1,
            'items_per_page' => count($items),
            'page_number' => 1
        );

        return $page;
    }

    public static function doAction($request, $match)
    {
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
            self::checkAccess($request, $order);
        }
        $action = $request->REQUEST['action'];
        $manager = $order->getManager();
        if ($manager->apply($order, $action, true)) {
            $updatedOrder = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $order->id);
            return $updatedOrder;
        }
        return new \Pluf\Exception('An error is occurred while processing order');
    }
}
