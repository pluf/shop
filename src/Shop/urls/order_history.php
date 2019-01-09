<?php
return array(
    // ************************************************************* OrderHistory
    array(
        'regex' => '#^/orders/(?P<orderId>\d+)/histories$#',
        'model' => 'Shop_Views_OrderHistory',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::memberRequired'
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
            'User_Precondition::memberRequired'
        )
    ),
//     array(
//         'regex' => '#^/orders/(?P<orderId>\d+)/histories/(?P<historyId>\d+)$#',
//         'model' => 'Shop_Views_OrderHistory',
//         'method' => 'delete',
//         'http-method' => 'DELETE',
//         'precond' => array(
//             'User_Precondition::ownerRequired'
//         )
//     ),
//     array(
//         'regex' => '#^/orders/(?P<orderId>\d+)/histories/(?P<historyId>\d+)$#',
//         'model' => 'Shop_Views_OrderHistory',
//         'method' => 'update',
//         'http-method' => 'POST',
//         'precond' => array(
//             'User_Precondition::ownerRequired'
//         )
//     )
);