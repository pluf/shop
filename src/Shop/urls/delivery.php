<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/deliveries/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Delivery'
        )
    ),
    // ************************************************************* Delivery
    array( // Find
        'regex' => '#^/deliveries$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Delivery'
        )
    ),
    array( // Create
        'regex' => '#^/deliveries$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_Delivery'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Get info
        'regex' => '#^/deliveries/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Delivery'
        )
    ),
    array( // Delete
        'regex' => '#^/deliveries/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Shop_Delivery',
            'permanently' => true
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array( // Update
        'regex' => '#^/deliveries/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_Delivery'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    )
);