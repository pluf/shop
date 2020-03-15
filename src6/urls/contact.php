<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/contacts/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Contact'
        )
    ),
    // ************************************************************* Contact
    array( // Find
        'regex' => '#^/contacts$#',
        'model' => 'Shop_Views_Contact',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Create
        'regex' => '#^/contacts$#',
        'model' => 'Shop_Views_Contact',
        'method' => 'create',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Get info
        'regex' => '#^/contacts/(?P<contactId>\d+)$#',
        'model' => 'Shop_Views_Contact',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/contacts/(?P<contactId>\d+)$#',
        'model' => 'Shop_Views_Contact',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Update
        'regex' => '#^/contacts/(?P<contactId>\d+)$#',
        'model' => 'Shop_Views_Contact',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    )
);