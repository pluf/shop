<?php
return array(
    // ************************************************************* Shop Agency
    array(
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
    array(
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
    array(
        'regex' => '#^/agency/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Agency'
        )
    ),
    array(
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
    array(
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
    )
);
