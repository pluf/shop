<?php
return array(
    // ************************************************************* TaxClass
    array( // Find
        'regex' => '#^/tax/find$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_TaxClass',
            'listFilters' => array(
                'id',
                'title',
                'rate'
            ),
            'searchFields' => array(
                'title',
                'rate'
            ),
            'sortFields' => array(
                'id',
                'title',
                'rate'
            )
        )
    ),
    array( // Create
        'regex' => '#^/tax/new$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_TaxClass'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Get info
        'regex' => '#^/tax/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_TaxClass'
        )
    ),
    array( // Delete
        'regex' => '#^/tax/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Shop_TaxClass',
            'permanently' => true
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Update
        'regex' => '#^/tax/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_TaxClass'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    )
);