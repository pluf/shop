<?php
Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');

class Shop_Views_OrderItem
{

    /**
     * یک آیتم جدید به سفارش اضافه می‌کند.
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @return Pluf_HTTP_Response_Json
     */
    public static function create($request, $match)
    {
        $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
        $user = $request->user;
        // Note: Hadi - 1396-05-06: only customer of order could add item to its order.
        if ($user->id !== $order->customer) {
            return new Pluf_Exception_Unauthorized('You are not allowed to do this action.');
        }
        // $originItem = Pluf_Shortcuts_GetObjectOr404($request->REQUEST['item_type'], $request->REQUEST['item_id']);
        $extra = array(
            'order' => $order
            // 'title' => $originItem->title,
            // 'price' => $originItem->price,
            // 'off' => $originItem->off
        );
        $orderItem = Pluf::factory('Shop_OrderItem');
        $form = Pluf_Shortcuts_GetFormForModel($orderItem, $request->REQUEST, $extra);
        $orderItem = $form->save();
        return new Pluf_HTTP_Response_Json($orderItem);
    }

    /**
     * یک آیتم جدید به سفارش اضافه می‌کند.
     * سفارش از secureId تعیین می‌شود
     * بنابراین نیازی به بررسی دسترسی‌های خاص نیست.
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @return Pluf_HTTP_Response_Json
     */
    public static function createBySecureId($request, $match)
    {
        $order = Shop_Views_Order::getOrderBySecureId($match['secureId']);
        // $originItem = Pluf_Shortcuts_GetObjectOr404($request->REQUEST['item_type'], $request->REQUEST['item_id']);
        $extra = array(
            'order' => $order
            // 'title' => $originItem->title,
            // 'price' => $originItem->price,
            // 'off' => $originItem->off
        );
        $orderItem = Pluf::factory('Shop_OrderItem');
        $form = Pluf_Shortcuts_GetFormForModel($orderItem, $request, $extra);
        $orderItem = $form->save();
        return new Pluf_HTTP_Response_Json($orderItem);
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
        $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
        Shop_Views_Order::checkAccess($request, $order);
        $pag = new Pluf_Paginator(new Shop_OrderItem());
        $pag->forced_where = Pluf_SQL('order=' . $match['orderId']);
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
        $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
        Shop_Views_Order::checkAccess($request, $order);
        $orderItem = Pluf_Shortcuts_GetObjectOr404('Shop_OrderItem', $match['itemId']);
        // اجرای درخواست
        return new Pluf_HTTP_Response_Json($orderItem);
    }

    /**
     * درخواست را به روز می‌کند
     *
     * @param unknown $request            
     * @param unknown $match            
     */
    public static function update($request, $match)
    {
        $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
        Shop_Views_Order::checkAccess($request, $order);
        $orderItem = Pluf_Shortcuts_GetObjectOr404('Shop_OrderItem', $match['itemId']);
        $form = Pluf_Shortcuts_GetFormForModel($orderItem, $request->REQUEST);
        return new Pluf_HTTP_Response_Json($form->save());
    }

    /**
     * درخواست را حذف می‌کند.
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @return Pluf_HTTP_Response_Json
     */
    public static function delete($request, $match)
    {
        $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
        Shop_Views_Order::checkAccess($request, $order);
        $orderItem = Pluf_Shortcuts_GetObjectOr404('Shop_OrderItem', $match['itemId']);
        $orderItem->delete();
        return new Pluf_HTTP_Response_Json($orderItem);
    }
}