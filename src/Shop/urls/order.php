<?php
return array(
    // ************************************************************* Order
    array( // find orders
        'regex' => '#^/order/find$#',
        'model' => 'Shop_Views_Order',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::authorizedRequired'
        )
    ),
    array( // create new order
        'regex' => '#^/order/new$#',
        'model' => 'Shop_Views_Order',
        'method' => 'create',
        'http-method' => 'POST'
    ),
    array( // get order info
        'regex' => '#^/order/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // get order info (by secure id)
        'regex' => '#^/order/(?P<secureId>[^/]+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'getBySecureId',
        'http-method' => 'GET',
        'precond' => array()
    ),
    array( // delete order
        'regex' => '#^/order/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // update order
        'regex' => '#^/order/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::memberRequired'
        )
    ),
    // ************************************************************* Processing Order
    array( // get possible actions
        'regex' => '#^/order/(?P<orderId>\d+)/actions$#',
        'model' => 'Shop_Views_Order',
        'method' => 'actions',
        'http-method' => 'GET',
        'precond' => array(),
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // get possible actions (by secure id)
        'regex' => '#^/order/(?P<secureId>[^/]+)/actions$#',
        'model' => 'Shop_Views_Order',
        'method' => 'actions',
        'http-method' => 'GET',
        'precond' => array(),
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // do action on order
        'regex' => '#^/order/(?P<orderId>\d+)/actions$#',
        'model' => 'Shop_Views_Order',
        'method' => 'doAction',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // do action on order (by secure id)
        'regex' => '#^/order/(?P<secureId>[^/]+)/actions#',
        'model' => 'Shop_Views_Order',
        'method' => 'doAction',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* Order Payments
    array( // pay for order
        'regex' => '#^/order/(?P<orderId>\d+)/payment$#',
        'model' => 'Shop_Views_Order',
        'method' => 'pay',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Check payment state of order 
        'regex' => '#^/order/(?P<orderId>\d+)/payment$#',
        'model' => 'Shop_Views_Order',
        'method' => 'payInfo',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::ownerRequired'
        )
    ),
    // ************************************************************* Order Deliver Type
    array( // set deliver type
        'regex' => '#^/order/(?P<orderId>\d+)/deliver/(?P<deliverId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'setDeliverType',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // set deliver type
        'regex' => '#^/order/(?P<secureId>[^/]+)/deliver/(?P<deliverId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'setDeliverType',
        'http-method' => 'POST'
    )
);