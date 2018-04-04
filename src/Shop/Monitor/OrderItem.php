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
     * Conts of order items
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return number
     */
    public static function count($request, $match){
        return 113;
    }

    /**
     * Conts of orders
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return number
     */
    public static function serviceCount($request, $match)
    {
        return 114;
    }

    /**
     * Conts of orders
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return number
     */
    public static function productCount($request, $match)
    {
        return 115;
    }
}