<?php

/**
 * Manages order
 * 
 * If 'secureId' is sets into the REQUEST parameters, then access MUST not checked.
 *
 * @author maso<mostafa.barmshory@dpq.co.ir>
 * @author hadi<mohammad.hadi.mansouri@dpq.co.ir>
 */
interface Shop_Order_Manager
{

    /**
     * Creates an order filter
     *
     * @param Pluf_HTTP_Request $request
     * @return Pluf_SQL
     */
    public function createOrderFilter ($request);

    /**
     * Apply action on order
     *
     * Each order must follow CRUD actions in life cycle. Here is default action
     * list:
     *
     * <ul>
     * <li>create</li>
     * <li>read</li>
     * <li>update</li>
     * <li>delete</li>
     * </ul>
     *
     * @param Shop_Order $order
     * @param String $action
     * @return Shop_Order
     */
    public function apply ($order, $action);

    /**
     * Returns possible transitions for given order
     * 
     * Returns possible transitions respect to currecnt state of given order.
     *
     * @param Shop_Order $order
     * @return array array of transitions
     */
    public function transitions ($order);
}