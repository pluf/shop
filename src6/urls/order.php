<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/orders/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Order'
        )
    ),
    // ************************************************************* Order
    array( // Create
        'regex' => '#^/orders$#',
        'model' => 'Shop_Views_Order',
        'method' => 'create',
        'http-method' => 'POST'
    ),
    array( // Read (list)
        'regex' => '#^/orders$#',
        'model' => 'Shop_Views_Order',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read
        'regex' => '#^/orders/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read (by secure id)
        'regex' => '#^/orders/(?P<secureId>[^/]+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'getBySecureId',
        'http-method' => 'GET'
    ),
    array( // Update
        'regex' => '#^/orders/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::memberRequired'
        )
    ),
    array( // Update (by secure id)
        'regex' => '#^/orders/(?P<secureId>[^/]+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'update',
        'http-method' => 'POST'
    ),
    array( // Delete
        'regex' => '#^/orders/(?P<orderId>\d+)$#',
        'model' => 'Shop_Views_Order',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    // ************************************************************* Processing Order
    array( // get possible actions
        'regex' => '#^/orders/(?P<orderId>\d+)/possible-transitions$#',
        'model' => 'Shop_Views_Order',
        'method' => 'actions',
        'http-method' => 'GET'
    ),
    array( // get possible actions (by secure id)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/possible-transitions$#',
        'model' => 'Shop_Views_Order',
        'method' => 'actions',
        'http-method' => 'GET'
    ),
    array( // do action on order
        'regex' => '#^/orders/(?P<orderId>\d+)/transitions$#',
        'model' => 'Shop_Views_Order',
        'method' => 'doAction',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::memberRequired'
        )
    ),
    // ************************************************************* Order Payments
    array( // pay for order
        'regex' => '#^/orders/(?P<orderId>\d+)/payments$#',
        'model' => 'Shop_Views_Order',
        'method' => 'pay',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // pay for order (by secure id)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/payments$#',
        'model' => 'Shop_Views_Order',
        'method' => 'pay',
        'http-method' => 'POST'
    ),
    array( // Check payment state of order
        'regex' => '#^/orders/(?P<orderId>\d+)/payments$#',
        'model' => 'Shop_Views_Order',
        'method' => 'payInfo',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Check payment state of order (by secure id)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/payments$#',
        'model' => 'Shop_Views_Order',
        'method' => 'payInfo',
        'http-method' => 'GET'
    ),
    // ************************************************************* Metafields of Order
    array( // Create
        'regex' => '#^/orders/(?P<parentId>\d+)/metafields$#',
        'model' => 'Shop_Views_OrderMetafield',
        'method' => 'createOrUpdate',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/orders/(?P<parentId>\d+)/metafields$#',
        'model' => 'Shop_Views_OrderMetafield',
        'method' => 'findManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_OrderMetafield',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        )
    ),
    array( // Read
        'regex' => '#^/orders/(?P<parentId>\d+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderMetafield',
        'method' => 'getManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_OrderMetafield',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        )
    ),
    array( // Read
        'regex' => '#^/orders/(?P<parentId>\d+)/metafields/(?P<modelKey>[^/]+)$#',
        'model' => 'Shop_Views_OrderMetafield',
        'method' => 'getByKey',
        'http-method' => 'GET'
    ),
    array( // Update
        'regex' => '#^/orders/(?P<parentId>\d+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderMetafield',
        'method' => 'updateManyToOne',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_OrderMetafield',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Update (by key)
        'regex' => '#^/orders/(?P<parentId>\d+)/metafields/(?P<modelKey>[^/]+)$#',
        'model' => 'Shop_Views_OrderMetafield',
        'method' => 'updateByKey',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/orders/(?P<parentId>\d+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderMetafield',
        'method' => 'deleteManyToOne',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Shop_OrderMetafield',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    // ************************************************************* Metafields of Order (by Secure Id)
    array( // Create
        'regex' => '#^/orders/(?P<secureId>[^/]+)/metafields$#',
        'model' => 'Shop_Views_OrderMetafield',
        'method' => 'createOrUpdate',
        'http-method' => 'POST'
    ),
    array( // Read (list)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/metafields$#',
        'model' => 'Shop_Views_OrderMetafield',
        'method' => 'findByOrderSecureId',
        'http-method' => 'GET'
    ),
    array( // Read
        'regex' => '#^/orders/(?P<secureId>[^/]+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderMetafield',
        'method' => 'getByOrderSecureId',
        'http-method' => 'GET'
    ),
    array( // Read
        'regex' => '#^/orders/(?P<secureId>[^/]+)/metafields/(?P<modelKey>[^/]+)$#',
        'model' => 'Shop_Views_OrderMetafield',
        'method' => 'getByKey',
        'http-method' => 'GET'
    ),
    array( // Update
        'regex' => '#^/orders/(?P<secureId>[^/]+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderMetafield',
        'method' => 'updateByOrderSecureId',
        'http-method' => 'POST'
    ),
    array( // Update (by key)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/metafields/(?P<modelKey>[^/]+)$#',
        'model' => 'Shop_Views_OrderMetafield',
        'method' => 'updateByKey',
        'http-method' => 'POST'
    ),
    array( // Delete
        'regex' => '#^/orders/(?P<secureId>[^/]+)/metafields/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderMetafield',
        'method' => 'deleteByOrderSecureId',
        'http-method' => 'DELETE'
    )
);
