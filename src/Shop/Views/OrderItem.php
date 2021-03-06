<?php
Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');

class Shop_Views_OrderItem
{

    /**
     * یک آیتم جدید به سفارش اضافه می‌کند.
     * سفارش یا از طریق id تعیین می‌شود که در این صورت ایجاد کننده آیتم باید مالک سفارش باشد
     * یا از طریق secureId تعیین می‌شود که در این صورت فرض می‌شود ایجاد کننده
     * درخواست مالک سفارش است و بررسی خاصی صورت نمی‌گیرد
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return Shop_OrderItem
     */
    public static function create($request, $match)
    {
        // TODO: Hadi: if item is added previously to order it is good to increase its count only
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
            // Receipt for order is created and status of receipt is payed
            throw new Pluf_Exception_PermissionDenied('Could not change items of already payed order');
        }
        if (! isset($match['count']) || $match['count'] == 0) {
            $match['count'] = 1;
        }
        $form = Pluf_Shortcuts_GetFormForModel(Pluf::factory('Shop_OrderItem'), $request->REQUEST);
        $orderItem = $form->save(false);
        $orderItem->order_id = $order;
        $orderItem->create();

        // Remove payment because it is not valid yet (here receipt is created but is not payed yet).
        // TODO: Hadi 1396-05: remove related receipt / or uupdate receipt info instead of remove it
        $order->__set('payment_id', null);
        $order->update();

        return $orderItem;
    }

    /**
     * فهرست کردن تقاضا‌های موجود
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return Pluf_Paginator
     */
    public static function find($request, $match)
    {
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
            Shop_Views_Order::checkAccess($request, $order);
        }
        $pag = new Pluf_Paginator(new Shop_OrderItem());
        $pag->forced_where = new Pluf_SQL('`order_id`=' . $order->id);
        $pag->list_filters = array(
            'id',
            'title',
            'item_id',
            'item_type',
            'price',
            'off',
            'order'
        );
        $search_fields = array(
            'title'
        );
        $sort_fields = array(
            'id',
            'title',
            'item_id',
            'item_type',
            'price',
            'off',
            'creation_dtime',
            'order'
        );
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
     * @return Shop_OrderItem
     */
    public static function get($request, $match)
    {
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
            Shop_Views_Order::checkAccess($request, $order);
        }
        /**
         *
         * @var Shop_OrderItem $orderItem
         */
        $orderItem = Pluf_Shortcuts_GetObjectOr404('Shop_OrderItem', $match['itemId']);
        if (! $orderItem->isBelongTo($order)) {
            throw new Pluf_HTTP_Error404('Order with id ' . $order->id . ' has no item with id ' . $orderItem->id);
        }
        // اجرای درخواست
        return $orderItem;
    }

    /**
     * درخواست را به روز می‌کند
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     */
    public static function update($request, $match)
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
            throw new Pluf_Exception_PermissionDenied('Could not change info of already payed order');
        }
        /**
         *
         * @var Shop_OrderItem $orderItem
         */
        $orderItem = Pluf_Shortcuts_GetObjectOr404('Shop_OrderItem', $match['itemId']);
        if (! $orderItem->isBelongTo($order)) {
            throw new Pluf_HTTP_Error404('Order with id ' . $order->id . ' has no item with id ' . $orderItem->id);
        }
        $form = Pluf_Shortcuts_GetFormForUpdateModel($orderItem, $request->REQUEST);
        $orderItem = $form->save();

        // Remove payment because it is not valid yet.
        // TODO: Hadi 1396-05: remove related receipt / or uupdate receipt info instead of remove it
        $order->invalidatePayment();
        $order->update();

        return $orderItem;
    }

    /**
     * درخواست را حذف می‌کند.
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return Shop_OrderItem
     */
    public static function delete($request, $match)
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
            throw new Pluf_Exception_PermissionDenied('Could not change items of already payed order');
        }
        $orderItem = Pluf_Shortcuts_GetObjectOr404('Shop_OrderItem', $match['itemId']);
        if (! $orderItem->isBelongTo($order)) {
            throw new Pluf_HTTP_Error404('Order with id ' . $order->id . ' has no item with id ' . $orderItem->id);
        }
        $orderItem->delete();

        // Remove payment because it is not valid yet.
        // TODO: Hadi 1396-05: remove related receipt / or uupdate receipt info instead of remove it
        $order->invalidatePayment();
        $order->update();

        return $orderItem;
    }
}
