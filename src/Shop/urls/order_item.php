<?php
return array(
    // ************************************************************* OrderItem
    array( // Find
        'regex' => '#^/order/(?P<orderId>\d+)/item/find$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'Pluf_Precondition::loginRequired'
        )
    ),
    array( // Find (by secureId of order)
        'regex' => '#^/order/(?P<secureId>[^/]+)/item/find$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Create
        'regex' => '#^/order/(?P<orderId>\d+)/item/new$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'create',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::loginRequired'
        )
    ),
    array( // Create (by secureId of order)
        'regex' => '#^/order/(?P<secureId>[^/]+)/item/new$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'create',
        'http-method' => 'POST'
    ),
    array( // Get info
        'regex' => '#^/order/(?P<orderId>\d+)/item/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'Pluf_Precondition::loginRequired'
        )
    ),
    array( // Get info (by secureId of order)
        'regex' => '#^/order/(?P<secureId>[^/]+)/item/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Delete
        'regex' => '#^/order/(?P<orderId>\d+)/item/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired'
        )
    ),
    array( // Delete (by secureId of order)
        'regex' => '#^/order/(?P<secureId>[^/]+)/item/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'delete',
        'http-method' => 'DELETE'
    ),
    array( // Update
        'regex' => '#^/order/(?P<orderId>\d+)/item/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::loginRequired'
        )
    ),
    array( // Update (by secure id of order)
        'regex' => '#^/order/(?P<secureId>[^/]+)/item/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'update',
        'http-method' => 'POST'
    )
);