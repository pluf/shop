<?php
return array(
    // ************************************************************* Address
    array( // Find
        'regex' => '#^/address/find$#',
        'model' => 'Shop_Views_Address',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Create
        'regex' => '#^/address/new$#',
        'model' => 'Shop_Views_Address',
        'method' => 'create',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Get info
        'regex' => '#^/address/(?P<addressId>\d+)$#',
        'model' => 'Shop_Views_Address',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/address/(?P<addressId>\d+)$#',
        'model' => 'Shop_Views_Address',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Update
        'regex' => '#^/address/(?P<addressId>\d+)$#',
        'model' => 'Shop_Views_Address',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    )
);