<?php

class Shop_Order_Event
{

    public const PROPERTY_COMMENT = array(
        'name' => 'description',
        'type' => 'String',
        'unit' => 'none',
        'title' => 'Description',
        'description' => 'A description text to put to the history',
        'editable' => true,
        'visible' => true,
        'priority' => 5,
        'defaultValue' => '',
        'validators' => []
    );

    public const PROPERTY_ZONE_ID = array(
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

    public const PROPERTY_ACCOUNT_ID = array(
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

    public const ACCEPT_ACTION = array(
        'Shop_Order_Event',
        'accept'
    );

    public const ACCEPT_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT
    );

    public const PAY_ACTION = array(
        'Shop_Order_Event',
        'pay'
    );

    public const PAY_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT
    );

    public const REJECT_ACTION = array(
        'Shop_Order_Event',
        'reject'
    );

    public const REJECT_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT
    );

    public const SET_ZONE_ACTION = array(
        'Shop_Order_Event',
        'setZone'
    );

    public const SET_ZONE_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT,
        Shop_Order_Event::PROPERTY_ZONE_ID
    );

    public const SET_ASSIGNEE_ACTION = array(
        'Shop_Order_Event',
        'setAssignee'
    );

    public const SET_ASSIGNEE_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT,
        Shop_Order_Event::PROPERTY_ACCOUNT_ID
    );

    public const DONE_ACTION = array(
        'Shop_Order_Event',
        'done'
    );

    public const DONE_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT
    );

    public const ARCHIVE_ACTION = array(
        'Shop_Order_Event',
        'archive'
    );

    public const ARCHIVE_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT
    );

    public const UPDATE_ACTION = array(
        'Shop_Order_Event',
        'update'
    );

    public const UPDATE_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT
        // TODO: maso, 2018: add all attributes
    );

    public const DELETE_ACTION = array(
        'Shop_Order_Event',
        'delete'
    );

    public const DELETE_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT
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
        if (!array_key_exists('zone_id', $request->REQUEST)) {
            throw new Pluf_Exception_BadRequest('zone_id is required');
        }
        $zoneId = $request->REQUEST['zone_id'];
        $zone = new Shop_Zone($zoneId);
        if ($zone->isAnonymous()) {
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
        if (!array_key_exists('account_id', $request->REQUEST)) {
            throw new Pluf_Exception_BadRequest('account_id is required');
        }
        $accountId = $request->REQUEST['account_id'];
        $account = new User_Account($accountId);
        if ($account->isAnonymous()) {
            throw new Pluf_Exception('Requested account dose not exist', 4000, null, 404);
        }
        $order->assignee_id = $account;
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