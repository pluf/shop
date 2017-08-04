<?php
return array(
    // ************************************************************* Shop Agency
    array( // Find
        'regex' => '#^/agency/find$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Agency',
            'sql' => new Pluf_SQL('deleted=false'),
            'listFilters' => array(
                'id',
                'title',
                'province',
                'city',
                'address',
                'phone'
            ),
            'listDisplay' => array(
                'title' => 'title',
                'province' => 'province',
                'city' => 'city',
                'address' => 'address',
                'phone' => 'phone',
                'description' => 'description'
            ),
            'searchFields' => array(
                'title',
                'province',
                'city',
                'address',
                'phone',
                'description'
            ),
            'sortFields' => array(
                'id',
                'title',
                'province',
                'city',
                'phone',
                'point',
                'creation_date',
                'modif_dtime'
            )
        )
    ),
    array( // Create
        'regex' => '#^/agency/new$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Agency'
        )
    ),
    array( // Get info
        'regex' => '#^/agency/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Agency'
        )
    ),
    array( // Delete
        'regex' => '#^/agency/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Agency',
            'permanently' => false
        )
    ),
    array( // Update info
        'regex' => '#^/agency/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Agency'
        )
    ),
    // ************************************************************* Owners of Agency
    array( // Find owners
        'regex' => '#^/agency/(?P<agencyId>\d+)/owner/find$#',
        'model' => 'Shop_Views_Agency',
        'method' => 'owners',
        'http-method' => 'GET',
        'precond' => array(
            'Pluf_Precondition::loginRequired'
        )
    ),
    array( // Add owner
        'regex' => '#^/agency/(?P<agencyId>\d+)/owner/new$#',
        'model' => 'Shop_Views_Agency',
        'method' => 'addOwner',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        )
    ),
    array( // Add owner
        'regex' => '#^/agency/(?P<agencyId>\d+)/owner/(?P<userId>\d+)$#',
        'model' => 'Shop_Views_Agency',
        'method' => 'addOwner',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        )
    ),
    array( // Delete owner
        'regex' => '#^/agency/(?P<agencyId>\d+)/owner/(?P<userId>\d+)$#',
        'model' => 'Shop_Views_Agency',
        'method' => 'removeOwner',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        )
    )
);
