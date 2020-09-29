<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/agencies/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Agency'
        )
    ),
    // ************************************************************* Shop Agency
    array( // Find
        'regex' => '#^/agencies$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Agency',
            'sql' => 'deleted=false'
        )
    ),
    array( // Create
        'regex' => '#^/agencies$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Agency'
        )
    ),
    array( // Get info
        'regex' => '#^/agencies/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Agency'
        )
    ),
    array( // Delete
        'regex' => '#^/agencies/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Agency',
            'permanently' => false
        )
    ),
    array( // Update info
        'regex' => '#^/agencies/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Agency'
        )
    ),
    // ************************************************************* Owners of Agency
    array( // Find owners
        'regex' => '#^/agencies/(?P<agencyId>\d+)/owners$#',
        'model' => 'Shop_Views_Agency',
        'method' => 'owners',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Add owner
        'regex' => '#^/agencies/(?P<agencyId>\d+)/owners$#',
        'model' => 'Shop_Views_Agency',
        'method' => 'addOwner',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Add owner
        'regex' => '#^/agencies/(?P<agencyId>\d+)/owners/(?P<userId>\d+)$#',
        'model' => 'Shop_Views_Agency',
        'method' => 'addOwner',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Delete owner
        'regex' => '#^/agencies/(?P<agencyId>\d+)/owners/(?P<userId>\d+)$#',
        'model' => 'Shop_Views_Agency',
        'method' => 'removeOwner',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    )
);
