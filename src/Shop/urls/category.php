<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/categories/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Category'
        )
    ),
    // ************************************************************* Category
    array( // Create
        'regex' => '#^/categories$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_Category'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Read
        'regex' => '#^/categories/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Category'
        )
    ),
    array( // Read (list)
        'regex' => '#^/categories$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Category'
        )
    ),
    array( // Update
        'regex' => '#^/categories/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_Category'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/categories/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Shop_Category',
            'permanently' => true
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    // ************************************************************* Metafields of Category
    array( // Create
        'regex' => '#^/categories/(?P<parentId>\d+)/metafields$#',
        'model' => 'Shop_Views_CategoryMetafield',
        'method' => 'createOrUpdate',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/categories/(?P<parentId>\d+)/metafields$#',
        'model' => 'Shop_Views_CategoryMetafield',
        'method' => 'findManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_CategoryMetafield',
            'parent' => 'Shop_Category',
            'parentKey' => 'category_id'
        )
    ),
    array( // Read
        'regex' => '#^/categories/(?P<parentId>\d+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_CategoryMetafield',
        'method' => 'getManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_CategoryMetafield',
            'parent' => 'Shop_Category',
            'parentKey' => 'category_id'
        )
    ),
    array( // Read
        'regex' => '#^/categories/(?P<parentId>\d+)/metafields/(?P<modelKey>[^/]+)$#',
        'model' => 'Shop_Views_CategoryMetafield',
        'method' => 'getByKey',
        'http-method' => 'GET'
    ),
    array( // Update
        'regex' => '#^/categories/(?P<parentId>\d+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_CategoryMetafield',
        'method' => 'updateManyToOne',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_CategoryMetafield',
            'parent' => 'Shop_Category',
            'parentKey' => 'category_id'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Update (by key)
        'regex' => '#^/categories/(?P<parentId>\d+)/metafields/(?P<modelKey>[^/]+)$#',
        'model' => 'Shop_Views_CategoryMetafield',
        'method' => 'updateByKey',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/categories/(?P<parentId>\d+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_CategoryMetafield',
        'method' => 'deleteManyToOne',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Shop_CategoryMetafield',
            'parent' => 'Shop_Category',
            'parentKey' => 'category_id'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
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
        'regex' => '#^/categories/(?P<categoryId>\d+)/(?P<item>[^/]+)/(?P<id>\d+)$#',
        'model' => 'Shop_Views_Category',
        'method' => 'addItem',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array(
        'regex' => '#^/categories/(?P<categoryId>\d+)/(?P<item>[^/]+)/(?P<id>\d+)$#',
        'model' => 'Shop_Views_Category',
        'method' => 'removeItem',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    )
);