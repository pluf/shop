<?php

class Shop_Order_Event_Simple extends Shop_Order_Event
{

    /*
     * Actions
     */
    public const ACCEPT_ACTION = array(
        'Shop_Order_Event',
        'accept'
    );

    public const ACCEPT_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT
    );

    public const REJECT_ACTION = array(
        'Shop_Order_Event',
        'reject'
    );

    public const REJECT_PROPERTIES = array(
        Shop_Order_Event::PROPERTY_COMMENT
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
    // End of actions
    
    
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
}

