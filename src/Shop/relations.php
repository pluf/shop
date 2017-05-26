<?php
return array(
    'Shop_Product' => array(
        'relate_to_many' => array(
            'Shop_TaxClass'
        )
    ),
    'Shop_Service' => array(
        'relate_to_many' => array(
            'Shop_TaxClass'
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
    )
);
