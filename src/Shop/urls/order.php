<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/orders/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Order'
        )
    ),
    // ************************************************************* Order
    array( // Create
        'regex' => '#^/orders$#',
        'model' => 'Shop_Views_Order',
        'method' => 'create',
        'http-method' => 'POST'
    ),
    array( // Read (list)
        'regex' => '#^/orders$#',
        'model' => 'Shop_Views_Order',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read
        'regex' => '#^/orders/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read (by secure id)
        'regex' => '#^/orders/(?P<secureId>[^/]+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'getBySecureId',
        'http-method' => 'GET'
    ),
    array( // Update
        'regex' => '#^/orders/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::memberRequired'
        )
    ),
    array( // Update (by secure id)
        'regex' => '#^/orders/(?P<secureId>[^/]+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'update',
        'http-method' => 'POST'
    ),
    array( // Delete
        'regex' => '#^/orders/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    // ************************************************************* Processing Order
    array( // get possible actions
        'regex' => '#^/orders/(?P<orderId>\d+)/possible-transitions$#',
        'model' => 'Shop_Views_Order',
        'method' => 'actions',
        'http-method' => 'GET'
    ),
    array( // get possible actions (by secure id)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/possible-transitions$#',
        'model' => 'Shop_Views_Order',
        'method' => 'actions',
        'http-method' => 'GET'
    ),
    array( // do action on order
        'regex' => '#^/orders/(?P<orderId>\d+)/transitions$#',
        'model' => 'Shop_Views_Order',
        'method' => 'doAction',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    // ************************************************************* Order Payments
    array( // pay for order
        'regex' => '#^/orders/(?P<orderId>\d+)/payments$#',
        'model' => 'Shop_Views_Order',
        'method' => 'pay',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // pay for order (by secure id)
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
            'User_Precondition::loginRequired'
        )
    ),
    array( // Check payment state of order (by secure id)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/payments$#',
        'model' => 'Shop_Views_Order',
        'method' => 'payInfo',
        'http-method' => 'GET'
    )
);
