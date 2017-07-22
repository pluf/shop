<?php
return array(
    // ************************************************************* Zone
    array(
        'regex' => '#^/zone/find$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Zone',
            'sql' => new Pluf_SQL('deleted=false'),
            'listFilters' => array(
                'id',
                'title',
                'province',
                'city',
                'address',
                'deleted',
                'owner'
            ),
            'searchFields' => array(
                'title',
                'province',
                'city',
                'address',
                'description'
            ),
            'sortFields' => array(
                'id',
                'title',
                'province',
                'city',
                'owner',
                'creation_date',
                'modif_dtime'
            )
        )
    ),
    array(
        'regex' => '#^/zone/new$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Zone'
        )
    ),
    array(
        'regex' => '#^/zone/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Zone'
        )
    ),
    array(
        'regex' => '#^/zone/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Zone',
            'permanently' => false
        )
    ),
    array(
        'regex' => '#^/zone/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Zone'
        )
    ),
    
    array(
        'regex' => '#^/zone/(?P<zoneId>\d+)/member/find$#',
        'model' => 'Shop_Views_Zone',
        'method' => 'members',
        'http-method' => 'GET',
        'precond' => array(
            'Pluf_Precondition::loginRequired'
        )
    ),
    array(
        'regex' => '#^/zone/(?P<zoneId>\d+)/member/new$#',
        'model' => 'Shop_Views_Zone',
        'method' => 'addMember',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        )
    ),
    array(
        'regex' => '#^/zone/(?P<zoneId>\d+)/member/(?P<userId>\d+)$#',
        'model' => 'Shop_Views_Zone',
        'method' => 'addMember',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        )
    ),
    array(
        'regex' => '#^/zone/(?P<zoneId>\d+)/member/(?P<userId>\d+)$#',
        'model' => 'Shop_Views_Zone',
        'method' => 'removeMember',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        )
    )
);