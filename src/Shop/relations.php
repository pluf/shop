<?php
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
    'Shop_OrderItem' => array(
        'relate_to' => array(
            'Shop_Order'
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
        // XXX: note: hadi, 1396-03: commented to avoid casecade deleting *****
        // 'relate_to' => array(
        // 'CMS_Content',
        // 'Shop_Category'
        // ),
        // *****
    ),
    'Shop_Tag' => array()
);
