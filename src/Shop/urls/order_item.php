<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/orders/(?P<parentId>\d+)/items/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_OrderItem'
        )
    ),
    // ************************************************************* OrderItem
    array( // Create
        'regex' => '#^/orders/(?P<orderId>\d+)/items$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'create',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/orders/(?P<orderId>\d+)/items$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read
        'regex' => '#^/orders/(?P<orderId>\d+)/items/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/orders/(?P<orderId>\d+)/items/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Update
        'regex' => '#^/orders/(?P<orderId>\d+)/items/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* OrderItem (by secureId of order)
    array( // Create (by secureId of order)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'create',
        'http-method' => 'POST'
    ),
    array( // Read (list) (by secureId of order)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Read (by secureId of order)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Delete (by secureId of order)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'delete',
        'http-method' => 'DELETE'
    ),
    array( // Update (by secureId of order)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'update',
        'http-method' => 'POST'
    )
);