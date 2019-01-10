<?php

class Shop_Order_Event
{

    public static $PROPERTY_COMMENT = array(
        'name' => 'comment',
        'type' => 'String',
        'unit' => 'none',
        'title' => 'Comment',
        'description' => 'A text to put to the history',
        'editable' => true,
        'visible' => true,
        'priority' => 5,
        'defaultValue' => '',
        'validators' => []
    );
    
    public static $PROPERTY_ZONE_ID = array(
        'name' => 'zone_id',
        'type' => 'Long',
        'unit' => 'none',
        'title' => 'Zone',
        'description' => 'A zone to set to the order',
        'editable' => true,
        'visible' => true,
        'priority' => 10,
        'defaultValue' => '',
        'validators' => [
            'NotNull',
            'Positive'
        ]
    );
    
    public static $PROPERTY_ACCOUNT_ID = array(
        'name' => 'account_id',
        'type' => 'Long',
        'unit' => 'none',
        'title' => 'Account',
        'description' => 'An account to set as assignee to the order',
        'editable' => true,
        'visible' => true,
        'priority' => 11,
        'defaultValue' => '',
        'validators' => [
            'NotNull',
            'Positive'
        ]
    );

    public static $ACCEPT_ACTION = array(
        'Shop_Order_Event',
        'setAssignee'
    );

    public static $ACCEPT_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT
    );

    public static $PAY_ACTION = array(
        'Shop_Order_Event',
        'pay'
    );

    public static $PAY_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT
    );

    public static $REJECT_ACTION = array(
        'Shop_Order_Event',
        'reject'
    );

    public static $REJECT_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT
    );

    public static $SET_ZONE_ACTION = array(
        'Shop_Order_Event',
        'setZone'
    );

    public static $SET_ZONE_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT,
        Shop_Order_Event::PROPERTY_ZONE_ID
    );

    public static $SET_ASSIGNEE_ACTION = array(
        'Shop_Order_Event',
        'setAssignee'
    );

    public static $SET_ASSIGNEE_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT,
        Shop_Order_Event::PROPERTY_ACCOUNT_ID_ID
    );

    public static $DONE_ACTION = array(
        'Shop_Order_Event',
        'setAssignee'
    );

    public static $DONE_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT
    );

    public static $ARCHIVE_ACTION = array(
        'Shop_Order_Event',
        'archive'
    );

    public static $ARCHIVE_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT
    );
    
    public static $UPDATE_ACTION = array(
        'Shop_Order_Event',
        'update'
    );
    
    public static $UPDATE_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT,
        // TODO: maso, 2018: add all attributes
    );
    

    /**
     * Adds comment into the order
     * 
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function addComment($request, $object)
    {
        // TODO: maso, 2018: add a comment to the order
    }
    
    
    /**
     * Accept an order
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function accept($request, $object)
    {
        self::addComment($request, $object);
    }

    /**
     * Reject an order
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function reject($request, $object)
    {
        self::addComment($request, $object);
    }

    /**
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function pay($request, $object)
    {
        self::addComment($request, $object);
    }

    /**
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function setZone($request, $order)
    {
        self::addComment($request, $order);
        if(array_key_exists('zone_id', $request->REQUEST)) {
            throw new Pluf_Exception_BadRequest('zone_id is required');
        }
        $zoneId = $request->REQUEST['zone_id'];
        $zone = new Shop_Zone($zoneId);
        if($zone->isAnonymous()){
            throw new Pluf_Exception('Requested zone dose not exist', 4000, null, 404);
        }
        $order->zone_id = $zone;
    }

    /**
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function setAssignee($request, $order)
    {
        self::addComment($request, $order);
        if(array_key_exists('account_id', $request->REQUEST)) {
            throw new Pluf_Exception_BadRequest('account_id is required');
        }
        $accountId = $request->REQUEST['account_id'];
        $account = new User_Account($accountId);
        if($account->isAnonymous()){
            throw new Pluf_Exception('Requested account dose not exist', 4000, null, 404);
        }
        $order->account_id = $account;
    }

    /**
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function done($request, $object)
    {
        self::addComment($request, $object);
    }

    /**
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function reject($request, $object)
    {
        self::addComment($request, $object);
    }

    /**
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function archive($request, $object)
    {
        self::addComment($request, $object);
    }
    
    /**
     * Update an order
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function update($request, $order)
    {
        self::addComment($request, $order);
        $forme = Pluf_Shortcuts_GetFormForUpdateModel($order, $request->REQUEST);
        $forme->save(false);
    }
    
    /**
     * Deletes an order
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function delete($request, $order)
    {
        self::addComment($request, $order);
        $order->deleted = true;
    }
}