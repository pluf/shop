<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/zones/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Zone'
        )
    ),
    // ************************************************************* Zone
    array( // Find
        'regex' => '#^/zones$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Zone',
            'sql' => new Pluf_SQL('deleted=false')
        )
    ),
    array( // Create
        'regex' => '#^/zones$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Zone'
        )
    ),
    array( // Get info
        'regex' => '#^/zones/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Zone'
        )
    ),
    array( // Delete
        'regex' => '#^/zones/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Zone',
            'permanently' => false
        )
    ),
    array( // Update info
        'regex' => '#^/zones/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Zone'
        )
    ),
    // ************************************************************* Members of Zone
    array( // Find members
        'regex' => '#^/zones/(?P<zoneId>\d+)/members$#',
        'model' => 'Shop_Views_Zone',
        'method' => 'members',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Add member
        'regex' => '#^/zones/(?P<zoneId>\d+)/members$#',
        'model' => 'Shop_Views_Zone',
        'method' => 'addMember',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Add member
        'regex' => '#^/zones/(?P<zoneId>\d+)/members/(?P<userId>\d+)$#',
        'model' => 'Shop_Views_Zone',
        'method' => 'addMember',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Delete member
        'regex' => '#^/zones/(?P<zoneId>\d+)/members/(?P<userId>\d+)$#',
        'model' => 'Shop_Views_Zone',
        'method' => 'removeMember',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    )
    // TODO: Hadi 1395-05: add REST to manage owner of zone
);