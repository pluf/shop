<?php
return array(
    'Shop_Address' => array(
        'relate_to_many' => array(
            'Pluf_User'
        )
    ),
    'Shop_Agency' => array(
        'relate_to_many' => array(
            'Pluf_User'
        ),
        'relate_to' => array(
            'CMS_Content'
        )
    ),
    'Shop_Contact' => array(
        'relate_to_many' => array(
            'Pluf_User'
        )
    ),
    'Shop_DeliverType' => array(
        'relate_to_many' => array(
            'Assort_Category',
            'Assort_Tag'
        )
    ),
    'Shop_Order' => array(
        'relate_to' => array(
            'Pluf_User',
            'Bank_Receipt',
            'Shop_DeliverType',
            'Shop_Zone',
            'Shop_Agency'
        )
    ),
    'Shop_OrderItem' => array(
        'relate_to' => array(
            'Shop_Order'
        )
    ),
    'Shop_Product' => array(
        'relate_to_many' => array(
            'Shop_TaxClass',
            'Assort_Category',
            'Assort_Tag'
        )
    ),
    'Shop_Service' => array(
        'relate_to_many' => array(
            'Shop_TaxClass',
            'Assort_Category',
            'Assort_Tag'
        )
    ),
    'Shop_Zone' => array(
        'relate_to' => array(
            'Pluf_User'
        ),
        'relate_to_many' => array(
            'Pluf_User'
        )
    )
);
