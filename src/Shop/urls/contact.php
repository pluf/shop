<?php
return array(
    // ************************************************************* Contact
    array( // Find
        'regex' => '#^/contact/find$#',
        'model' => 'Shop_Views_Contact',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Create
        'regex' => '#^/contact/new$#',
        'model' => 'Shop_Views_Contact',
        'method' => 'create',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Get info
        'regex' => '#^/contact/(?P<contactId>\d+)$#',
        'model' => 'Shop_Views_Contact',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/contact/(?P<contactId>\d+)$#',
        'model' => 'Shop_Views_Contact',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Update
        'regex' => '#^/contact/(?P<contactId>\d+)$#',
        'model' => 'Shop_Views_Contact',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    )
);