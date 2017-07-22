<?php
return array(
    // ************************************************************* Address
    array( // Find
        'regex' => '#^/address/find$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Address',
            'listFilters' => array(
                'id',
                'province',
                'city',
                'point',
                'user'
            ),
            'searchFields' => array(
                'province',
                'city',
                'address'
            ),
            'sortFields' => array(
                'id',
                'province',
                'city',
                'point',
                'user'
            )
        )
    ),
    array( // Create
        'regex' => '#^/address/new$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_Address'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Get info
        'regex' => '#^/address/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Address'
        )
    ),
    array( // Delete
        'regex' => '#^/address/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Shop_Address',
            'permanently' => true
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Update
        'regex' => '#^/address/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_Address'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    )
    
    // TODO: Hadi: add REST to add/remove address for users
);