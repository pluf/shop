<?php
return array(
    // ************************************************************* Tag
    array( // Create
        'regex' => '#^/tags$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_Tag'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Read
        'regex' => '#^/tags/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Tag'
        )
    ),
    array( // Read (by name)
        'regex' => '#^/tags/(?P<name>[^/]+)$#',
        'model' => 'Shop_Views_Tag',
        'method' => 'getByName',
        'http-method' => 'GET'
    ),
    array( // Read (list)
        'regex' => '#^/tags$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Tag'
        )
    ),
    array( // Update
        'regex' => '#^/tags/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_Tag'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/tags/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Shop_Tag',
            'permanently' => true
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    // ************************************************************* Items (product or service) with Tag
    array(
        'regex' => '#^/tags/(?P<tagId>\d+)/(?P<item>[^/]+)$#',
        'model' => 'Shop_Views_Tag',
        'method' => 'items',
        'http-method' => 'GET'
    ),
    array(
        'regex' => '#^/tags/(?P<tagId>\d+)/(?P<item>[^/]+)$#',
        'model' => 'Shop_Views_Tag',
        'method' => 'addItem',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array(
        'regex' => '#^/tags/(?P<tagId>\d+)/(?P<item>[^/]+)/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_Tag',
        'method' => 'addItem',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array(
        'regex' => '#^/tags/(?P<tagId>\d+)/(?P<item>[^/]+)/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_Tag',
        'method' => 'removeItem',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    )
);