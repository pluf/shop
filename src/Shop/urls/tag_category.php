<?php
return array(
    // ************************************************************* Items (product or service) in Category
    array(
        'regex' => '#^/categories/(?P<categoryId>\d+)/(?P<item>[^/]+)$#',
        'model' => 'Shop_Views_Category',
        'method' => 'items',
        'http-method' => 'GET'
    ),
    array(
        'regex' => '#^/categories/(?P<categoryId>\d+)/(?P<item>[^/]+)$#',
        'model' => 'Shop_Views_Category',
        'method' => 'addItem',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array(
        'regex' => '#^/categories/(?P<categoryId>\d+)/(?P<item>[^/]+)/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_Category',
        'method' => 'addItem',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array(
        'regex' => '#^/categories/(?P<categoryId>\d+)/(?P<item>[^/]+)/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_Category',
        'method' => 'removeItem',
        'http-method' => 'DELETE',
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