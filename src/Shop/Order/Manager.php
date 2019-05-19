<?php

/**
 * Manages orders in different states and handles events on orders.
 * 
 * The order manager should manage orders in different states and handle events on orders.
 * Each implementation could define its own states and events for orders. 
 * However all implementations should handle the following events:
 * <ul>
 * <li>create: to create a new order this event will be occured</li>
 * <li>update: to update an order this event will be occured</li>
 * <li>delete: to delete an order this event will be occured</li>
 * </ul>
 * 
 * Note: If 'secureId' is sets in the REQUEST parameters, then access MUST not be checked.
 *
 * @author maso<mostafa.barmshory@dpq.co.ir>
 * @author hadi<mohammad.hadi.mansouri@dpq.co.ir>
 */
interface Shop_Order_Manager
{

    /**
     * Creates an order filter
     * 
     * This filter is used to list orders based on states and the request. For
     * example, all orders will be displayed to the owner of the system.
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
     * @param Boolean $save to save or not the order
     * @return Shop_Order
     */
    public function apply ($order, $action, $save = false);

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