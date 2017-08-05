<?php
return array(
    // ************************************************************* Order
    array( // find orders
        'regex' => '#^/order/find$#',
        'model' => 'Shop_Views_Order',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'Pluf_Precondition::authorizedRequired'
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
            'Pluf_Precondition::loginRequired'
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
            'Pluf_Precondition::ownerRequired'
        )
    ),
    array( // update order
        'regex' => '#^/order/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::memberRequired'
        )
    ),
    // ************************************************************* Processing Order
    array( // get possible next states
        'regex' => '#^/order/(?P<orderId>\d+)/states$#',
        'model' => 'Shop_Views_Order',
        'method' => 'states',
        'http-method' => 'GET',
        'precond' => array(),
        'precond' => array(
            'Pluf_Precondition::loginRequired'
        )
    ),
    array( // get possible actions (by secure id)
        'regex' => '#^/order/(?P<secureId>[^/]+)/states$#',
        'model' => 'Shop_Views_Order',
        'method' => 'states',
        'http-method' => 'GET',
        'precond' => array(),
        'precond' => array(
            'Pluf_Precondition::loginRequired'
        )
    ),
    array( // do action on order
        'regex' => '#^/order/(?P<orderId>\d+)/state/(?P<state>[^/]+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'putToState',
        'http-method' => 'PUT',
        'precond' => array(
            'Pluf_Precondition::loginRequired'
        )
    ),
    array( // do action on order (by secure id)
        'regex' => '#^/order/(?P<secureId>[^/]+)/state/(?P<state>[^/]+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'putToState',
        'http-method' => 'PUT',
        'precond' => array(
            'Pluf_Precondition::loginRequired'
        )
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
    array( // Check payment state of order 
        'regex' => '#^/order/(?P<orderId>\d+)/payment$#',
        'model' => 'Shop_Views_Order',
        'method' => 'payInfo',
        'http-method' => 'GET',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::ownerRequired'
        )
    ),
    // ************************************************************* Order Deliver Type
    array( // set deliver type
        'regex' => '#^/order/(?P<orderId>\d+)/deliver/(?P<deliverId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'setDeliverType',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::loginRequired'
        )
    ),
    array( // set deliver type
        'regex' => '#^/order/(?P<secureId>[^/]+)/deliver/(?P<deliverId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'setDeliverType',
        'http-method' => 'POST'
    )
);