<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/orders/(?P<parentId>\d+)/attachments/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Category'
        )
    ),
    array( // Create
        'regex' => '#^/orders/(?P<parentId>\d+)/attachments$#',
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'create',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/orders/(?P<parentId>\d+)/attachments$#',
        'model' => 'Pluf_Views',
        'method' => 'findManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id',
            'model' => 'Shop_OrderAttachment'
        )
    ),
    array( // Read
        'regex' => '#^/orders/(?P<orderId>\d+)/attachments/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_OrderAttachment'
        )
    ),

    array( // Delete
        'regex' => '#^/orders/(?P<orderId>\d+)/attachments/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        // 'precond' => array(
        // 'User_Precondition::ownerRequired'
        // ),
        'params' => array(
            'model' => 'Shop_OrderAttachment'
        )
    ),
    
    /*
     * Binary content of content
     */
    array( // Read
        'regex' => '#^/orders/(?P<orderId>\d+)/attachments/(?P<modelId>\d+)/content$#',
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'download',
        'http-method' => 'GET',
        // Cache apram
        'cacheable' => true,
        'revalidate' => true,
        'intermediate_cache' => true,
        'max_age' => 25000
    )
);


