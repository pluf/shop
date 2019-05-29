<?php

/**
 * Default Order manager
 *
 * @author hadi<mohammad.hadi.mansouri@dpq.co.ir>
 * @author maso<mostafa.barmshory@dpq.co.ir>
 */
class Shop_Order_Manager_SimplePreconditions
{

    /**
     * Checks if requester is allowed to update the order.
     * Order could be updated if requester is owner of order or the feild 'secureId' is exsited in the request`s parameters.
     *  
     * @param Pluf_HTTP_Request $request
     * @return true if requester is allowed to update the order else false.
     */
    static public function canUpdateOrder ($request, $order)
    {
        // Check if request is by secure id
        if(array_key_exists('secureId', $request->REQUEST) && $order->secureId === $request->REQUEST['secureId']){
            return true;
        }
        if (! isset($request->user) or $request->user->isAnonymous()) {
            return false;
        }
        // Check if requester is owner of the order
        if($order->customer_id === $request->user->id){
            return true;
        }
        return false;
    }
    
}
