<?php
return array(
    // ************************************************************* Items (product or service) in Category
    array(
        'regex' => '#^/category/(?P<categoryId>\d+)/(?P<item>[^/]+)/find$#',
        'model' => 'Shop_Views_Category',
        'method' => 'items',
        'http-method' => 'GET'
    ),
    array(
        'regex' => '#^/category/(?P<categoryId>\d+)/(?P<item>[^/]+)/new$#',
        'model' => 'Shop_Views_Category',
        'method' => 'addItem',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array(
        'regex' => '#^/category/(?P<categoryId>\d+)/(?P<item>[^/]+)/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_Category',
        'method' => 'addItem',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array(
        'regex' => '#^/category/(?P<categoryId>\d+)/(?P<item>[^/]+)/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_Category',
        'method' => 'removeItem',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    // ************************************************************* Items (product or service) with Tag
    array(
        'regex' => '#^/tag/(?P<tagId>\d+)/(?P<item>[^/]+)/find$#',
        'model' => 'Shop_Views_Tag',
        'method' => 'items',
        'http-method' => 'GET'
    ),
    array(
        'regex' => '#^/tag/(?P<tagId>\d+)/(?P<item>[^/]+)/new$#',
        'model' => 'Shop_Views_Tag',
        'method' => 'addItem',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array(
        'regex' => '#^/tag/(?P<tagId>\d+)/(?P<item>[^/]+)/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_Tag',
        'method' => 'addItem',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array(
        'regex' => '#^/tag/(?P<tagId>\d+)/(?P<item>[^/]+)/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_Tag',
        'method' => 'removeItem',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    )
);