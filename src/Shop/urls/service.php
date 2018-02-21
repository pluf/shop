<?php
return array(
    // ************************************************************* Service
    array( // Find
        'regex' => '#^/service/find$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Service',
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
        'regex' => '#^/service/new$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_Service'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array( // Get info
        'regex' => '#^/service/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Service'
        )
    ),
    array( // Delete
        'regex' => '#^/service/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Shop_Service',
            'permanently' => true
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array( // Update
        'regex' => '#^/service/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_Service'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ), // ************************************************************* Taxes of Service
    array(
        'regex' => '#^/service/(?P<serviceId>\d+)/tax/find$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'serviceTaxes',
        'http-method' => 'GET'
    ),
    array(
        'regex' => '#^/service/(?P<serviceId>\d+)/tax/new$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'addServiceTax',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/service/(?P<serviceId>\d+)/tax/(?P<taxId>\d+)$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'addServiceTax',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/service/(?P<serviceId>\d+)/tax/(?P<taxId>\d+)$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'removeServiceTax',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    // ************************************************************* Categories of Service
    array(
        'regex' => '#^/service/(?P<modelId>\d+)/category/find$#',
        'model' => 'Shop_Views',
        'method' => 'categories',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Service'
        )
    ),
    array(
        'regex' => '#^/service/(?P<modelId>\d+)/category/new$#',
        'model' => 'Shop_Views',
        'method' => 'addCategory',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Service'
        )
    ),
    array(
        'regex' => '#^/service/(?P<modelId>\d+)/category/(?P<categoryId>\d+)$#',
        'model' => 'Shop_Views',
        'method' => 'addCategory',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Service'
        )
    ),
    array(
        'regex' => '#^/service/(?P<modelId>\d+)/category/(?P<categoryId>\d+)$#',
        'model' => 'Shop_Views',
        'method' => 'removeCategory',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Service'
        )
    ),
    // ************************************************************* Tags on Service
    array(
        'regex' => '#^/service/(?P<modelId>\d+)/tag/find$#',
        'model' => 'Shop_Views',
        'method' => 'tags',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Service'
        )
    ),
    array(
        'regex' => '#^/service/(?P<modelId>\d+)/tag/new$#',
        'model' => 'Shop_Views',
        'method' => 'addTag',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Service'
        )
    ),
    array(
        'regex' => '#^/service/(?P<modelId>\d+)/tag/(?P<tagId>\d+)$#',
        'model' => 'Shop_Views',
        'method' => 'addTag',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Service'
        )
    ),
    array(
        'regex' => '#^/service/(?P<modelId>\d+)/tag/(?P<tagId>\d+)$#',
        'model' => 'Shop_Views',
        'method' => 'removeTag',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Service'
        )
    )
);