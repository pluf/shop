<?php
return array(
    // ************************************************************* Contact
    array( // Find
        'regex' => '#^/contact/find$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Contact',
            'listFilters' => array(
                'id',
                'contact',
                'type',
                'user'
            ),
            'searchFields' => array(
                'contact',
                'type'
            ),
            'sortFields' => array(
                'id',
                'contact',
                'type',
                'user'
            )
        )
    ),
    array( // Create
        'regex' => '#^/contact/new$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_Contact'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Get info
        'regex' => '#^/contact/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Contact'
        )
    ),
    array( // Delete
        'regex' => '#^/contact/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Shop_Contact',
            'permanently' => true
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Update
        'regex' => '#^/contact/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_Contact'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    )
    
    // TODO: Hadi: add REST to add/remove contact for users
);