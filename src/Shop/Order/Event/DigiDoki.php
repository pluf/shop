<?php

class Shop_Order_Event_DigiDoki extends Shop_Order_Event
{

    /*
     * Properties
     */
    public const PROPERTY_WORKSHOP_ID = self::PROPERTY_AGENCY_ID;

    public const PROPERTY_DATETIME = array(
        'name' => 'datetime',
        'type' => 'Datetime',
        'unit' => 'none',
        'title' => 'Date & Time',
        'description' => 'Date and time',
        'editable' => true,
        'visible' => true,
        'priority' => 5,
        'defaultValue' => '',
        'validators' => []
    );

    public const PROPERTY_TOTAL_PRICE = array(
        'name' => 'total_cost',
        'type' => 'Long',
        'unit' => 'none',
        'title' => 'Total Cost',
        'description' => 'Total cost of order',
        'editable' => true,
        'visible' => true,
        'priority' => 11,
        'defaultValue' => '',
        'validators' => [
            'NotNull',
            'Positive'
        ]
    );

    public const PROPERTY_SPARE_PRICE = array(
        'name' => 'spare_cost',
        'type' => 'Long',
        'unit' => 'none',
        'title' => 'Spare Cost',
        'description' => 'Spare cost of order',
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

    public const SCHEDULE_PROPERTIES = array(
        self::PROPERTY_DATETIME,
        Self::PROPERTY_ADDRESS,
        self::PROPERTY_COMMENT
    );

    public const FIX_ACTION = array(
        'Shop_Order_Event_DigiDoki',
        'fix'
    );

    public const FIX_PROPERTIES = array(
        self::PROPERTY_TOTAL_PRICE,
        self::PROPERTY_SPARE_PRICE,
        self::PROPERTY_COMMENT
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
    public static function isCrm($request)
    {
        return User_Precondition::isOwner($request);
    }

    public static function isZoneOwner($request)
    {
        return User_Precondition::isOwner($request);
    }

    public static function isFixer($request)
    {
        return User_Precondition::isOwner($request);
    }

    public static function isWorkshopOwner($request)
    {
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

    public static function setFixer($request, $order)
    {
        self::addComment($request, $order);
        if (! array_key_exists('account_id', $request->REQUEST)) {
            throw new Pluf_Exception_BadRequest('account_id of fixer is required');
        }
        $fixerId = $request->REQUEST['account_id'];
        $fixer = new User_Account($fixerId);
        if ($fixer->isAnonymous()) {
            throw new Pluf_Exception_DoesNotExist('Determined fixer dose not exist');
        }
        $order->assignee_id = $fixer;
    }

    public static function setCosts($request, $order)
    {
        $totalCost = $request->REQUEST['total_cost'];
        $spareCost = $request->REQUEST['spare_cost'];
        // order-item for spares and wages
        self::creatOrderItem('Spares', $spareCost, 1, $order);
        self::creatOrderItem('Wages', $totalCost - $spareCost, 1, $order);
    }

    private static function verifyCosts($request)
    {
        if (! isset($request->REQUEST['total_cost'])) {
            throw new Pluf_Exception_BadRequest('total_cost is required');
        }
        if (! isset($request->REQUEST['spare_cost'])) {
            throw new Pluf_Exception_BadRequest('spare_cost is required');
        }
        $totalCost = $request->REQUEST['total_cost'];
        $spareCost = $request->REQUEST['spare_cost'];
        if (! is_numeric($totalCost)) {
            throw new Pluf_Exception_BadRequest('Total cost is not a valid value: ' . $totalCost);
        }
        if (! is_numeric($spareCost)) {
            throw new Pluf_Exception_BadRequest('Spare cost is not a valid value: ' . $spareCost);
        }
        if ($totalCost < $spareCost) {
            throw new Pluf_Exception_BadRequest('Total cost could not be lesser than spare cost');
        }
        return true;
    }

    /**
     * Creates an order-item with given data
     *
     * @param string $title
     * @param number $price
     * @param number $count
     * @param Shop_Order $order
     * @return Shop_OrderItem
     */
    private static function creatOrderItem($title, $price, $count, $order)
    {
        $item = new Shop_OrderItem();
        $item->title = $title;
        $item->count = $count;
        $item->price = $price;
        $item->order_id = $order;
        $item->create();
        return $item;
    }

    /**
     * Transfers the commission from wallet of current user to the main wallet of the tenant.
     * The main wallet of the tenant could be determined in the settings of tenant by the key 'digidoci.main_wallet_id'.
     * If main wallet of tenant is not determined the 'to_wallet' feild of the transfer will be empty.
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $order
     */
    public static function transferCommission($request, $order)
    {
        $totalCost = $request->REQUEST['total_cost'];
        $spareCost = $request->REQUEST['spare_cost'];
        $commission = ($totalCost - $spareCost) * 0.2;
        if ($commission <= 0.0) {
            throw new Pluf_Exception_BadRequest('Invalid value for commission. Commission should be a positive value.');
        }
        // Get wallet of current user
        $currency = Tenant_Service::setting('local.currency', NULL);
        if($currency == NULL){
            throw new Pluf_Exception_SettingError('Local currency of tenant is not set. Set it first.');
        }
        $wallets = Bank_Service::getWallets($request->user, $currency);
        if (count($wallets) === 0) {
            throw new Pluf_Exception_DoesNotExist('You have not any wallet with current currency, so you can not do this action.');
        }
        $fromWallet = $wallets[0]; // Get first wallet as main wallet of user
        $toWallet = null;
        $wId = Tenant_Service::setting('tenant.main_wallet_id', 0);
        if ($wId > 0) {
            Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
            $toWallet = Pluf_Shortcuts_GetObjectOr404('Bank_Wallet', $wId);
            if ($toWallet->deleted) {
                $toWallet = null;
            }
        }
        // Check for invalid transfer
        // Check if balance of source wallet is sufficeint
        $sourceBalance = $fromWallet->total_deposit - $fromWallet->total_withdraw;
        if ($sourceBalance < $commission) {
            throw new Pluf_Exception_BadRequest('Insufficeint balance [balance: ' . $sourceBalance . ', transfer: ' . $commission . '].');
        }
        // Create transfer
        $transfer = new Bank_Transfer();
        $transfer->_a['cols']['amount']['editable'] = true;
        $transfer->_a['cols']['acting_id']['editable'] = true;
        $transfer->_a['cols']['from_wallet_id']['editable'] = true;
        $transfer->_a['cols']['to_wallet_id']['editable'] = true;
        Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');
        $data = array(
            'amount' => $commission,
            'description' => Tenant_Service::setting('digidoci.commission_transfer_description', 'DigiDoki commission.') . 'Request ID: ' . $order->id,
            'acting_id' => $request->user->id,
            'from_wallet_id' => $fromWallet->id,
            'to_wallet_id' => $toWallet !== null ? $toWallet->id : 0
        );
        $form = Pluf_Shortcuts_GetFormForModel($transfer, $data);
        $transfer = $form->save();
        // Update balance of wallets
        $fromWallet->total_withdraw += $transfer->amount;
        $fromWallet->update();
        if ($toWallet !== null) {
            $toWallet->total_deposit += $transfer->amount;
            $toWallet->update();
        }
    }

    public static function setWorkshop($request, $object)
    {
        return self::setAgency($request, $object);
    }

    public static function schedule($request, $order)
    {
        $time = Pluf_Shortcuts_GetRequestParamOr403($request, 'datetime');
        $address = Pluf_Shortcuts_GetRequestParamOr403($request, 'address');
        $desc = Pluf_Shortcuts_GetRequestParam($request, 'description');
        $desc = "$desc - $address - $time";
        $request->REQUEST['description'] = $desc;
        // Add meta data for time and location:
        self::createOrderMetafeild('time', $time, 'workflow', $order);
        self::createOrderMetafeild('address', $address, 'workflow', $order);
    }

    private static function createOrderMetafeild($key, $value, $namespace, $order)
    {
        $meta = new Shop_OrderMetafield();
        $temp = $meta->getMetafield($key, $order->id);
        if ($temp !== false) {
            $meta = $temp;
            $meta->value = $value;
            $meta->namespace = $namespace;
            $meta->update();
        } else {
            $meta->key = $key;
            $meta->value = $value;
            $meta->namespace = $namespace;
            $meta->order_id = $order;
            $meta->create();
        }
        return $meta;
    }

    public static function fix($request, $object)
    {
        self::verifyCosts($request);
        self::setCosts($request, $object);
        // transfer commision from fixer wallet to the main wallet of the tenant
        self::transferCommission($request, $object);
    }

    public static function workshopFix($request, $object)
    {
        return self::fix($request, $object);
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

