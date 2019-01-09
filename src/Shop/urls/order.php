<?php
return array(
    // ************************************************************* Order
    array( // find orders
        'regex' => '#^/orders$#',
        'model' => 'Shop_Views_Order',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::authorizedRequired'
        )
    ),
    array( // create new order
        'regex' => '#^/orders$#',
        'model' => 'Shop_Views_Order',
        'method' => 'create',
        'http-method' => 'POST'
    ),
    array( // get order info
        'regex' => '#^/orders/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // get order info (by secure id)
        'regex' => '#^/orders/(?P<secureId>[^/]+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'getBySecureId',
        'http-method' => 'GET',
        'precond' => array()
    ),
    array( // delete order
        'regex' => '#^/orders/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // update order
        'regex' => '#^/orders/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::memberRequired'
        )
    ),
    // ************************************************************* Processing Order
    array( // get possible actions
        'regex' => '#^/orders/(?P<orderId>\d+)/possible-transitions$#',
        'model' => 'Shop_Views_Order',
        'method' => 'actions',
        'http-method' => 'GET',
        'precond' => array(),
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // get possible actions (by secure id)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/possible-transitions$#',
        'model' => 'Shop_Views_Order',
        'method' => 'actions',
        'http-method' => 'GET',
        'precond' => array(),
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // do action on order
        'regex' => '#^/orders/(?P<orderId>\d+)/transitions$#',
        'model' => 'Shop_Views_Order',
        'method' => 'doAction',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // do action on order (by secure id)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/transitions#',
        'model' => 'Shop_Views_Order',
        'method' => 'doAction',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* Order Payments
    array( // pay for order
        'regex' => '#^/orders/(?P<orderId>\d+)/payments$#',
        'model' => 'Shop_Views_Order',
        'method' => 'pay',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::ownerRequired'
        )
    ),
    array( // pay for order by secure id
        'regex' => '#^/orders/(?P<secureId>[^/]+)/payments$#',
        'model' => 'Shop_Views_Order',
        'method' => 'pay',
        'http-method' => 'POST'
    ),
    array( // Check payment state of order
        'regex' => '#^/orders/(?P<orderId>\d+)/payments$#',
        'model' => 'Shop_Views_Order',
        'method' => 'payInfo',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Check payment state of order (by secure id)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/payments$#',
        'model' => 'Shop_Views_Order',
        'method' => 'payInfo',
        'http-method' => 'GET'
    )
);
