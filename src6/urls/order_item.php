<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/orders/(?P<parentId>\d+)/items/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_OrderItem'
        )
    ),
    // ************************************************************* OrderItem
    array( // Create
        'regex' => '#^/orders/(?P<orderId>\d+)/items$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'create',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/orders/(?P<orderId>\d+)/items$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read
        'regex' => '#^/orders/(?P<orderId>\d+)/items/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/orders/(?P<orderId>\d+)/items/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Update
        'regex' => '#^/orders/(?P<orderId>\d+)/items/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* OrderItem (by secureId of order)
    array( // Create (by secureId of order)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'create',
        'http-method' => 'POST'
    ),
    array( // Read (list) (by secureId of order)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Read (by secureId of order)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Delete (by secureId of order)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'delete',
        'http-method' => 'DELETE'
    ),
    array( // Update (by secureId of order)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items/(?P<itemId>\d+)$#',
        'model' => 'Shop_Views_OrderItem',
        'method' => 'update',
        'http-method' => 'POST'
    ),
    
    // ************************************************************* Metafields of OrderItem
    array( // Create
        'regex' => '#^/order_items/(?P<parentId>\d+)/metafields$#',
        'model' => 'Shop_Views_OrderItemMetafield',
        'method' => 'createOrUpdate',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/order_items/(?P<parentId>\d+)/metafields$#',
        'model' => 'Shop_Views_OrderItemMetafield',
        'method' => 'findManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_OrderItemMetafield',
            'parent' => 'Shop_OrderItem',
            'parentKey' => 'order_item_id'
        )
    ),
    array( // Read
        'regex' => '#^/order_items/(?P<parentId>\d+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderItemMetafield',
        'method' => 'getManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_OrderItemMetafield',
            'parent' => 'Shop_OrderItem',
            'parentKey' => 'order_item_id'
        )
    ),
    array( // Read
        'regex' => '#^/order_items/(?P<parentId>\d+)/metafields/(?P<modelKey>[^/]+)$#',
        'model' => 'Shop_Views_OrderItemMetafield',
        'method' => 'getByKey',
        'http-method' => 'GET'
    ),
    array( // Update
        'regex' => '#^/order_items/(?P<parentId>\d+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderItemMetafield',
        'method' => 'updateManyToOne',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_OrderItemMetafield',
            'parent' => 'Shop_OrderItem',
            'parentKey' => 'order_item_id'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Update (by key)
        'regex' => '#^/order_items/(?P<parentId>\d+)/metafields/(?P<modelKey>[^/]+)$#',
        'model' => 'Shop_Views_OrderItemMetafield',
        'method' => 'updateByKey',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/order_items/(?P<parentId>\d+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderItemMetafield',
        'method' => 'deleteManyToOne',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Shop_OrderItemMetafield',
            'parent' => 'Shop_OrderItem',
            'parentKey' => 'order_item_id'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    // ************************************************************* Metafields of OrderItem (by Secure Id of Order)
    array( // Create
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items/(?P<itemId>\d+)/metafields$#',
        'model' => 'Shop_Views_OrderItemMetafield',
        'method' => 'createOrUpdate',
        'http-method' => 'POST'
    ),
    array( // Read (list)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items/(?P<itemId>\d+)/metafields$#',
        'model' => 'Shop_Views_OrderItemMetafield',
        'method' => 'findByOrderSecureId',
        'http-method' => 'GET'
    ),
    array( // Read
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items/(?P<itemId>\d+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderItemMetafield',
        'method' => 'getByOrderSecureId',
        'http-method' => 'GET'
    ),
    array( // Read
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items/(?P<itemId>\d+)/metafields/(?P<modelKey>[^/]+)$#',
        'model' => 'Shop_Views_OrderItemMetafield',
        'method' => 'getByKey',
        'http-method' => 'GET'
    ),
    array( // Update
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items/(?P<itemId>\d+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderItemMetafield',
        'method' => 'updateByOrderSecureId',
        'http-method' => 'POST'
    ),
    array( // Update (by key)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items/(?P<itemId>\d+)/metafields/(?P<modelKey>[^/]+)$#',
        'model' => 'Shop_Views_OrderItemMetafield',
        'method' => 'updateByKey',
        'http-method' => 'POST'
    ),
    array( // Delete
        'regex' => '#^/orders/(?P<secureId>[^/]+)/items/(?P<itemId>\d+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderItemMetafield',
        'method' => 'deleteByOrderSecureId',
        'http-method' => 'DELETE'
    )
    
    
    
    
);