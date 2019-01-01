<?php
return array(
    // ************************************************************* Services
    array( // Find
        'regex' => '#^/services$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Service'
        )
    ),
    array( // Create
        'regex' => '#^/services$#',
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
        'regex' => '#^/services/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Service'
        )
    ),
    array( // Delete
        'regex' => '#^/services/(?P<modelId>\d+)$#',
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
        'regex' => '#^/services/(?P<modelId>\d+)$#',
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
    ), 
    // ************************************************************* Metafields of service
    array( //  Create
        'regex' => '#^/services/(?P<modelId>\d+)/metafields$#',
        'model' => 'Shop_Views_ServiceMetafield',
        'method' => 'createOrUpdate',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/services/(?P<modelId>\d+)/metafields$#',
        'model' => 'Shop_Views_ServiceMetafield',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Read
        'regex' => '#^/services/(?P<modelId>\d+)/metafields/(?P<id>\d+)$#',
        'model' => 'Shop_Views_ServiceMetafield',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update
        'regex' => '#^/services/(?P<modelId>\d+)/metafields/(?P<id>\d+)$#',
        'model' => 'Shop_Views_ServiceMetafield',
        'method' => 'createOrUpdate',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/services/(?P<modelId>\d+)/metafields/(?P<id>\d+)$#',
        'model' => 'Shop_Views_ServiceMetafield',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    // ************************************************************* Taxes of Service
    array(
        'regex' => '#^/services/(?P<serviceId>\d+)/taxes$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'serviceTaxes',
        'http-method' => 'GET'
    ),
    array(
        'regex' => '#^/services/(?P<serviceId>\d+)/taxes$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'addServiceTax',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/services/(?P<serviceId>\d+)/taxes/(?P<id>\d+)$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'addServiceTax',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/services/(?P<serviceId>\d+)/taxes/(?P<id>\d+)$#',
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
        'regex' => '#^/services/(?P<modelId>\d+)/categories$#',
        'model' => 'Shop_Views',
        'method' => 'categories',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Service'
        )
    ),
    array(
        'regex' => '#^/services/(?P<modelId>\d+)/categories$#',
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
        'regex' => '#^/services/(?P<modelId>\d+)/categories/(?P<id>\d+)$#',
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
        'regex' => '#^/services/(?P<modelId>\d+)/categories/(?P<id>\d+)$#',
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
        'regex' => '#^/services/(?P<modelId>\d+)/tags$#',
        'model' => 'Shop_Views',
        'method' => 'tags',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Service'
        )
    ),
    array(
        'regex' => '#^/services/(?P<modelId>\d+)/tags$#',
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
        'regex' => '#^/services/(?P<modelId>\d+)/tags/(?P<id>\d+)$#',
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
        'regex' => '#^/services/(?P<modelId>\d+)/tags/(?P<id>\d+)$#',
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