<?php
return array(
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
    'Shop_ProductItem' => array(
        'relate_to' => array(
            'Shop_Product',
            'Shop_Order'
        )
    ),
    'Shop_ServiceItem' => array(
        'relate_to' => array(
            'Shop_Service',
            'Shop_Order'
        )
    ),
    'Shop_Order' => array(
        'relate_to' => array(
            'Pluf_User'
        )
    ),
    'Shop_Agency' => array(
        'relate_to_many' => array(
            'Pluf_User'
        )
    ),
);
