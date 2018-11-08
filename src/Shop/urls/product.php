<?php
return array(
    // ************************************************************* Product
    array( // Find
        'regex' => '#^/products$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Product'
        )
    ),
    array( // Create
        'regex' => '#^/products$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_Product'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array( // Get info
        'regex' => '#^/products/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Product'
        )
    ),
    array( // Delete
        'regex' => '#^/products/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Shop_Product',
            'permanently' => true
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array( // Update
        'regex' => '#^/products/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_Product'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    // ************************************************************* Taxes of Products
    array(
        'regex' => '#^/products/(?P<productId>\d+)/taxes$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'productTaxes',
        'http-method' => 'GET'
    ),
    array(
        'regex' => '#^/products/(?P<productId>\d+)/taxes$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'addProductTax',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/products/(?P<productId>\d+)/taxes/(?P<taxId>\d+)$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'addProductTax',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/products/(?P<productId>\d+)/taxes/(?P<taxId>\d+)$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'removeProductTax',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    // ************************************************************* Categories of Product
    array(
        'regex' => '#^/products/(?P<modelId>\d+)/categories$#',
        'model' => 'Shop_Views',
        'method' => 'categories',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Product'
        )
    ),
    array(
        'regex' => '#^/products/(?P<modelId>\d+)/categories$#',
        'model' => 'Shop_Views',
        'method' => 'addCategory',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Product'
        )
    ),
    array(
        'regex' => '#^/products/(?P<modelId>\d+)/categories/(?P<categoryId>\d+)$#',
        'model' => 'Shop_Views',
        'method' => 'addCategory',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Product'
        )
    ),
    array(
        'regex' => '#^/products/(?P<modelId>\d+)/categories/(?P<categoryId>\d+)$#',
        'model' => 'Shop_Views',
        'method' => 'removeCategory',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Product'
        )
    ),
    // ************************************************************* Tags on Product
    array(
        'regex' => '#^/products/(?P<modelId>\d+)/tags$#',
        'model' => 'Shop_Views',
        'method' => 'tags',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Product'
        )
    ),
    array(
        'regex' => '#^/products/(?P<modelId>\d+)/tags$#',
        'model' => 'Shop_Views',
        'method' => 'addTag',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Product'
        )
    ),
    array(
        'regex' => '#^/products/(?P<modelId>\d+)/tags/(?P<tagId>\d+)$#',
        'model' => 'Shop_Views',
        'method' => 'addTag',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Product'
        )
    ),
    array(
        'regex' => '#^/products/(?P<modelId>\d+)/tags/(?P<tagId>\d+)$#',
        'model' => 'Shop_Views',
        'method' => 'removeTag',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Product'
        )
    )
);