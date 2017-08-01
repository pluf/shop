<?php
return array(
    // ************************************************************* DeliverType
    array( // Find
        'regex' => '#^/deliver/find$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_DeliverType',
            'listFilters' => array(
                'id',
                'title',
                'price',
                'off'
            ),
            'searchFields' => array(
                'title',
                'description'
            ),
            'sortFields' => array(
                'id',
                'title',
                'price',
                'off'
            )
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
            'Pluf_Precondition::ownerRequired'
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
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
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
            'Pluf_Precondition::ownerRequired'
        )
    )
);