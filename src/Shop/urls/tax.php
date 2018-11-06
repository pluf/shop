<?php
return array(
    // ************************************************************* TaxClass
    array( // Find
        'regex' => '#^/taxes$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_TaxClass'
        )
    ),
    array( // Create
        'regex' => '#^/taxes$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_TaxClass'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array( // Get info
        'regex' => '#^/taxes/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_TaxClass'
        )
    ),
    array( // Delete
        'regex' => '#^/taxes/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Shop_TaxClass',
            'permanently' => true
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array( // Update
        'regex' => '#^/taxes/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_TaxClass'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    )
);