<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/orders/(?P<parentId>\d+)/histories/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_OrderHistory'
        )
    ),
    // ************************************************************* OrderHistory
    array(
        'regex' => '#^/orders/(?P<orderId>\d+)/histories$#',
        'model' => 'Shop_Views_OrderHistory',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array(
        'regex' => '#^/orders/(?P<secureId>[^/]+)/histories$#',
        'model' => 'Shop_Views_OrderHistory',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array()
    ),
    array(
        'regex' => '#^/orders/(?P<orderId>\d+)/histories/(?P<historyId>\d+)$#',
        'model' => 'Shop_Views_OrderHistory',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    )
);

