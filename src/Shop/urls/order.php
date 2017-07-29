<?php
return array(
    // ************************************************************* Order
    array(
        'regex' => '#^/order/find$#',
        'model' => 'Shop_Views_Order',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'Pluf_Precondition::authorizedRequired'
        )
    ),
    array(
        'regex' => '#^/order/new$#',
        'model' => 'Shop_Views_Order',
        'method' => 'create',
        'http-method' => 'POST'
    ),
    array(
        'regex' => '#^/order/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'Pluf_Precondition::loginRequired'
        )
    ),
    array(
        'regex' => '#^/order/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        )
    ),
    array(
        'regex' => '#^/order/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/order/(?P<orderId>\d+)/(?P<action>[^/]+)$#',
        'model' => 'Shop_Views_OrderWorkflow',
        'method' => 'properties',
        'http-method' => 'GET',
        'precond' => array()
    ),
    array(
        'regex' => '#^/order/(?P<orderId>\d+)/(?P<action>[^/]+)$#',
        'model' => 'Shop_Views_OrderWorkflow',
        'method' => 'run',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::authorizedRequired'
        )
    ),
    array(
        'regex' => '#^/order/(?P<secureId>[^/]+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'getBySecureId',
        'http-method' => 'GET',
        'precond' => array()
    ),
    // ************************************************************* Order Payments
    array( // pay for order
        'regex' => '#^/order/(?P<orderId>\d+)/payment$#',
        'model' => 'Shop_Views_Order',
        'method' => 'pay',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::ownerRequired'
        )
    ),
    array( // Activate order that has been payed
        'regex' => '#^/order/(?P<orderId>\d+)/activate$#',
        'model' => 'Shop_Views_Order',
        'method' => 'checkPay',
        'http-method' => 'GET',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::ownerRequired'
        )
    ),
);