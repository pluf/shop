<?php

/**
 * Monitor order items
 * 
 * @author DPQ
 *
 */
class Shop_Monitor_OrderItem
{
    /**
     * Returns number of order items (includes products and services)
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return number
     */
    public static function count($request, $match){
        $model = new Shop_OrderItem();
        $params = array(
            'count' => true
        );
        $result = $model->getList($params);
        // convert to numeric value and return
        return $result[0]['nb_items'] + 0;
    }

    /**
     * Returns total number of services
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return number
     */
    public static function serviceCount($request, $match)
    {
        $model = new Shop_Service();
        $params = array(
            'count' => true
        );
        $result = $model->getList($params);
        // convert to numeric value and return
        return $result[0]['nb_items'] + 0;
    }

    /**
     * Returns total number of products
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return number
     */
    public static function productCount($request, $match)
    {
        $model = new Shop_Product();
        $params = array(
            'count' => true
        );
        $result = $model->getList($params);
        // convert to numeric value and return
        return $result[0]['nb_items'] + 0;
    }
}