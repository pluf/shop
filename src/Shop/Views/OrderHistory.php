<?php
Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');

class Shop_Views_OrderHistory
{

    /**
     * Returns history of order
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
        $pag = new Pluf_Paginator(new Shop_OrderHistory());
        $pag->forced_where = new Pluf_SQL('`order_id`=' . $order->id);
        $pag->list_filters = array(
            'id',
            'object_id',
            'object_type',
            'subject_id',
            'subject_type',
            'action',
            'state',
            'order_id'
        );
        $search_fields = array(
            'action',
            'state',
            'description',
            'creation_dtime'
        );
        $sort_fields = array(
            'id',
            'object_id',
            'object_type',
            'subject_id',
            'subject_type',
            'action',
            'state',
            'creation_dtime',
            'order_id'
        );
        $pag->items_per_page = Shop_Shortcuts_NormalizeItemPerPage($request);
        $pag->configure(array(), $search_fields, $sort_fields);
        $pag->setFromRequest($request);
        return $pag;
    }

    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @return Shop_OrderHistory
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
        $orderHistory = Pluf_Shortcuts_GetObjectOr404('Shop_OrderHistory', $match['historyId']);
        if ($orderHistory->order_id !== $order-id) {
            throw new Pluf_HTTP_Error404('Order with id ' . $order->id . ' has no history with id ' . $orderHistory->id);
        }
        // اجرای درخواست
        return $orderHistory;
    }

}

