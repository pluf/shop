<?php

class Shop_Order_Event
{

    /*
     * Properties
     */
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

    public const PROPERTY_DESCRIPTION = array(
        'name' => 'description',
        'type' => 'String',
        'unit' => 'none',
        'title' => 'Description',
        'description' => 'Description about order',
        'editable' => true,
        'visible' => true,
        'priority' => 5,
        'defaultValue' => '',
        'validators' => []
    );

    public const PROPERTY_TITLE = array(
        'name' => 'title',
        'type' => 'String',
        'unit' => 'none',
        'title' => 'Title',
        'description' => 'Title of order',
        'editable' => true,
        'visible' => true,
        'priority' => 5,
        'defaultValue' => '',
        'validators' => []
    );

    public const PROPERTY_FULL_NAME = array(
        'name' => 'full_name',
        'type' => 'String',
        'unit' => 'none',
        'title' => 'Fullname',
        'description' => 'Fullname of the customer',
        'editable' => true,
        'visible' => true,
        'priority' => 5,
        'defaultValue' => '',
        'validators' => []
    );

    public const PROPERTY_PHONE = array(
        'name' => 'phone',
        'type' => 'String',
        'unit' => 'none',
        'title' => 'Phone',
        'description' => 'Phone number of the customer',
        'editable' => true,
        'visible' => true,
        'priority' => 5,
        'defaultValue' => '',
        'validators' => []
    );

    public const PROPERTY_EMAIL = array(
        'name' => 'email',
        'type' => 'String',
        'unit' => 'none',
        'title' => 'EMail',
        'description' => 'EMail address of the customer',
        'editable' => true,
        'visible' => true,
        'priority' => 5,
        'defaultValue' => '',
        'validators' => []
    );

    public const PROPERTY_PROVINCE = array(
        'name' => 'province',
        'type' => 'String',
        'unit' => 'none',
        'title' => 'Province',
        'description' => 'Province which customer reside',
        'editable' => true,
        'visible' => true,
        'priority' => 5,
        'defaultValue' => '',
        'validators' => []
    );

    public const PROPERTY_CITY = array(
        'name' => 'city',
        'type' => 'String',
        'unit' => 'none',
        'title' => 'City',
        'description' => 'City which customer reside',
        'editable' => true,
        'visible' => true,
        'priority' => 5,
        'defaultValue' => '',
        'validators' => []
    );

    public const PROPERTY_ADDRESS = array(
        'name' => 'address',
        'type' => 'String',
        'unit' => 'none',
        'title' => 'Address',
        'description' => 'Address of the customer',
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

    public const PROPERTY_AGENCY_ID = array(
        'name' => 'agency_id',
        'type' => 'Long',
        'unit' => 'none',
        'title' => 'Agency',
        'description' => 'An agency to set to the order',
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

    // End of properties

    /*
     * Actions
     */
    public const PAY_ACTION = array(
        'Shop_Order_Event',
        'pay'
    );

    public const PAY_PROPERTIES = array(
        self::PROPERTY_COMMENT
    );

    public const SET_ZONE_ACTION = array(
        'Shop_Order_Event',
        'setZone'
    );

    public const SET_ZONE_PROPERTIES = array(
        self::PROPERTY_ZONE_ID,
        self::PROPERTY_COMMENT
    );

    public const SET_AGENCY_ACTION = array(
        'Shop_Order_Event',
        'setAgency'
    );

    public const SET_AGENCY_PROPERTIES = array(
        self::PROPERTY_AGENCY_ID,
        self::PROPERTY_COMMENT
    );

    public const SET_ASSIGNEE_ACTION = array(
        'Shop_Order_Event',
        'setAssignee'
    );

    public const SET_ASSIGNEE_PROPERTIES = array(
        self::PROPERTY_ACCOUNT_ID,
        self::PROPERTY_COMMENT
    );

    public const UPDATE_ACTION = array(
        'Shop_Order_Event',
        'update'
    );

    public const UPDATE_PROPERTIES = array(
        self::PROPERTY_TITLE,
        self::PROPERTY_DESCRIPTION,
        self::PROPERTY_FULL_NAME,
        self::PROPERTY_PHONE,
        self::PROPERTY_EMAIL,
        self::PROPERTY_PROVINCE,
        self::PROPERTY_CITY,
        self::PROPERTY_ADDRESS
    );

    public const DELETE_ACTION = array(
        'Shop_Order_Event',
        'delete'
    );

    public const DELETE_PROPERTIES = array(
        self::PROPERTY_COMMENT
        // TODO: maso, 2018: add all attributes
    );

    public const SEND_NOTIFICATION_ACTION = array(
        'Shop_Order_Event',
        'sendNotification'
    );

    // End of actions

    /**
     * Adds comment into the order
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function addComment($request, $object)
    {
        // TODO: maso, 2018: add a comment to the order

        // Note: hadi, 98-08-04: there is no need to do any action.
        // A history will be added by propagating an state change signal.
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
        if (! array_key_exists('zone_id', $request->REQUEST)) {
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
    public static function setAgency($request, $order)
    {
        self::addComment($request, $order);
        if (! array_key_exists('agency_id', $request->REQUEST)) {
            throw new Pluf_Exception_BadRequest('agency_id is required');
        }
        $agencyId = $request->REQUEST['agency_id'];
        $agency = new Shop_Agency($agencyId);
        if ($agency->isAnonymous()) {
            throw new Pluf_Exception('Requested agency dose not exist', 4000, null, 404);
        }
        $order->agency_id = $agency;
    }

    /**
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function setAssignee($request, $order)
    {
        self::addComment($request, $order);
        if (! array_key_exists('account_id', $request->REQUEST)) {
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

    public static function sendNotification($request, $object)
    {
        try {
            // Load notifier engine
            $type = class_exists('Tenant_Service') ? //
            Tenant_Service::setting('shop_order.notifier.engine', 'nonotify') : //
            Pluf::f('shop_order.notifier.engine', 'nonotify');

            $engine = Notifier_Service::getEngine($type);
            if (! $engine) {
                throw new Notifier_Exception_EngineLoad('Defined notifier engine does not exist.');
            }
            // TODO: hadi, 1398-11: improve to consider email notifiers or other type of notifiers (following code should be general)
            $data = array(
                'code' => $object->secureId,
                'receiver' => $object->phone
            );
            $engineResponse = $engine->send($data);
            if (! $engineResponse) {
                throw new Notifier_Exception_NotificationSend();
            }
        } catch (Exception $e) {
            // TODO: hadi, 1398-11: log the error
        }
    }
}