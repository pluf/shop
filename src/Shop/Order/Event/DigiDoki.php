<?php

class Shop_Order_Event_DigiDoki extends Shop_Order_Event
{

    /*
     * Properties
     */
    public const PROPERTY_WORKSHOP_ID = self::PROPERTY_AGENCY_ID;
    // End of properties 
    
    /*
     * Actions
     */
    public const ARCHIVE_ACTION = array(
        'Shop_Order_Event_DigiDoki',
        'archive'
    );
    
    public const ARCHIVE_PROPERTIES = array(
        self::PROPERTY_COMMENT
    );
    
    public const REPORT_ACTION = array(
        'Shop_Order_Event_DigiDoki',
        'report'
    );
    
    public const REPORT_PROPERTIES = array(
        Self::PROPERTY_COMMENT
    );
    
    public const SET_FIXER_ACTION = array(
        'Shop_Order_Event_DigiDoki',
        'setFixer'
    );
    
    public const SET_FIXER_PROPERTIES = array(
        self::PROPERTY_ACCOUNT_ID,
        Self::PROPERTY_COMMENT
        
    );
    
    public const CLOSE_ACTION = array(
        'Shop_Order_Event_DigiDoki',
        'close'
    );
    
    public const CLOSE_PROPERTIES = array(
        self::PROPERTY_ACCOUNT_ID,
        Self::PROPERTY_COMMENT
        
    );
    
    public const SET_WORKSHOP_ACTION = array(
        'Shop_Order_Event_DigiDoki',
        'setWorkshop'
    );
    
    public const SET_WORKSHOP_PROPERTIES = array(
        self::PROPERTY_WORKSHOP_ID,
        Self::PROPERTY_COMMENT
    );
    
    public const SCHEDULE_ACTION = array(
        'Shop_Order_Event_DigiDoki',
        'schedule'
    );
    
    public const FIX_ACTION = array(
        'Shop_Order_Event_DigiDoki',
        'fix'
    );
    
    public const WORKSHOP_FIX_ACTION = array(
        'Shop_Order_Event_DigiDoki',
        'workshopFix'
    );
    
    public const REOPEN_ACTION = array(
        'Shop_Order_Event_DigiDoki',
        'reopen'
    );
    // End of actions
    
    
    /*
     * Preconditions
     */
    public static function isCrm($request){
        return User_Precondition::isOwner($request);
    }
    
    public static function isZoneOwner($request){
        return User_Precondition::isOwner($request);
    }
    
    public static function isFixer($request){
        return User_Precondition::isOwner($request);
    }
    
    public static function isWorkshopOwner($request){
        return User_Precondition::isOwner($request);
    }
    // End of perconditions
    
    /**
     * Registers a report for the order
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function report($request, $object)
    {
        return self::addComment($request, $object);
    }
    
    public static function setFixer($request, $object)
    {
        return self::addComment($request, $object);
    }
    
    public static function setWorkshop($request, $object)
    {
        return self::addComment($request, $object);
    }
    
    public static function schedule($request, $object)
    {
        return self::addComment($request, $object);
    }
    
    public static function fix($request, $object)
    {
        return self::addComment($request, $object);
    }
    
    public static function workshopFix($request, $object)
    {
        return self::addComment($request, $object);
    }
    
    public static function reopen($request, $object)
    {
        return self::addComment($request, $object);
    }
    
    public static function close($request, $object)
    {
        return self::addComment($request, $object);
    }
    
    public static function archive($request, $object)
    {
        self::addComment($request, $object);
    }
}

