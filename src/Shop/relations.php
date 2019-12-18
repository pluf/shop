<?php

/*
 * Signals
 */

// Pluf_Signal::connect('Shop_Order::stateChange',
// array(
// 'Shop_Views_Manager_Abstract',
// 'sendNotification'
// ));
Pluf_Signal::connect('Shop_Order::stateChange', array(
    'Shop_Order_Manager_Abstract',
    'addOrderHistory'
));

return array(
    'Shop_Address' => array(
        'relate_to_many' => array(
            'User_Account'
        )
    ),
    'Shop_Agency' => array(
        'relate_to_many' => array(
            'User_Account'
        ),
        'relate_to' => array(
            'CMS_Content'
        )
    ),
    'Shop_Contact' => array(
        'relate_to_many' => array(
            'User_Account'
        )
    ),
    'Shop_Delivery' => array(
        'relate_to_many' => array(
            'Shop_Category',
            'Shop_Tag'
        )
    ),
    'Shop_Order' => array(
        'relate_to' => array(
            'User_Account',
            'Bank_Receipt',
            'Shop_Delivery',
            'Shop_Zone',
            'Shop_Agency'
        )
    ),
    'Shop_OrderMetafield' => array(
        'relate_to' => array(
            'Shop_Order'
        )
    ),
    'Shop_OrderItem' => array(
        'relate_to' => array(
            'Shop_Order'
        )
    ),
    'Shop_OrderItemMetafield' => array(
        'relate_to' => array(
            'Shop_OrderItem'
        )
    ),
    'Shop_OrderHistory' => array(
        'relate_to' => array(
            'Shop_Order'
        )
    ),
    'Shop_OrderAttachment' => array(
        'relate_to' => array(
            'Shop_Order'
        )
    ),
    'Shop_Product' => array(
        'relate_to_many' => array(
            'Shop_TaxClass',
            'Shop_ProductMetafield',
            'Shop_Category',
            'Shop_Tag'
        )
    ),
    'Shop_Service' => array(
        'relate_to_many' => array(
            'Shop_TaxClass',
            'Shop_ServiceMetafield',
            'Shop_Category',
            'Shop_Tag'
        )
    ),
    'Shop_Zone' => array(
        'relate_to' => array(
            'User_Account'
        ),
        'relate_to_many' => array(
            'User_Account'
        )
    ),
    'Shop_Category' => array(
        // NOTE: hadi, 1396-03: commented to avoid casecade deleting *****
        // XXX: maso, 2019: we must remove cascade delete from biz
        'relate_to' => array(
            // 'CMS_Content',
            'Shop_Category'
        )
    ),
    'Shop_CategoryMetafield' => array(
        'relate_to' => array(
            'Shop_Category'
        )
    ),
    'Shop_Tag' => array()
);
