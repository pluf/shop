<?php
return array(
    // ************************************************************* OrderHistory
    array(
        'regex' => '#^/order/(?P<orderId>\d+)/history/find$#',
        'model' => 'Shop_Views_OrderHistory',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'Pluf_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/order/(?P<orderId>\d+)/history/(?P<historyId>\d+)$#',
        'model' => 'Shop_Views_OrderHistory',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'Pluf_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/order/(?P<orderId>\d+)/history/(?P<historyId>\d+)$#',
        'model' => 'Shop_Views_OrderHistory',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        )
    ),
    array(
        'regex' => '#^/order/(?P<orderId>\d+)/history/(?P<historyId>\d+)$#',
        'model' => 'Shop_Views_OrderHistory',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        )
    ),
    array(
        'regex' => '#^/order/(?P<secureId>[^/]+)/history/find$#',
        'model' => 'Shop_Views_OrderHistory',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array()
    )
);