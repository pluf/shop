<?php
return array(
    // ************************************************************* DeliverType
    array( // Find
        'regex' => '#^/deliver/find$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_DeliverType'
        )
    ),
    array( // Create
        'regex' => '#^/deliver/new$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_DeliverType'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Get info
        'regex' => '#^/deliver/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_DeliverType'
        )
    ),
    array( // Delete
        'regex' => '#^/deliver/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Shop_DeliverType',
            'permanently' => true
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array( // Update
        'regex' => '#^/deliver/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_DeliverType'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    )
);