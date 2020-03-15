<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/addresses/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Address'
        )
    ),
    // ************************************************************* Address
    array( // Find
        'regex' => '#^/addresses$#',
        'model' => 'Shop_Views_Address',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Create
        'regex' => '#^/addresses$#',
        'model' => 'Shop_Views_Address',
        'method' => 'create',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Get info
        'regex' => '#^/addresses/(?P<addressId>\d+)$#',
        'model' => 'Shop_Views_Address',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/addresses/(?P<addressId>\d+)$#',
        'model' => 'Shop_Views_Address',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Update
        'regex' => '#^/addresses/(?P<addressId>\d+)$#',
        'model' => 'Shop_Views_Address',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    )
);