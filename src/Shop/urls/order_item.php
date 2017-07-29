<?php
return array(
    // ************************************************************* OrderItem
    array( // Find
        'regex' => '#^/order/(?P<orderId>\d+)/item/find$#',
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
    array( // Create by secureId of order
        'regex' => '#^/order/(?P<secureId>[^/]+)/item/new$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'createBySecureId',
        'http-method' => 'POST',
        'precond' => array()
    ),
    array( // Get info
        'regex' => '#^/order/(?P<orderId>\d+)/item/(?P<itemId>\d+)$#',
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
    array( // Update
        'regex' => '#^//order/(?P<orderId>\d+)/item/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_OrderItem'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired'
        )
    )
    // TODO: Hadi: add REST to action on items by using secureId of order.
);