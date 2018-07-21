<?php
return array(
    // ************************************************************* Product
    array( // Find
        'regex' => '#^/product/find$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Product'
        )
    ),
    array( // Create
        'regex' => '#^/product/new$#',
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
        'regex' => '#^/product/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Product'
        )
    ),
    array( // Delete
        'regex' => '#^/product/(?P<modelId>\d+)$#',
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
        'regex' => '#^/product/(?P<modelId>\d+)$#',
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
        'regex' => '#^/product/(?P<productId>\d+)/tax/find$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'productTaxes',
        'http-method' => 'GET'
    ),
    array(
        'regex' => '#^/product/(?P<productId>\d+)/tax/new$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'addProductTax',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/product/(?P<productId>\d+)/tax/(?P<taxId>\d+)$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'addProductTax',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/product/(?P<productId>\d+)/tax/(?P<taxId>\d+)$#',
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
        'regex' => '#^/product/(?P<modelId>\d+)/category/find$#',
        'model' => 'Shop_Views',
        'method' => 'categories',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Product'
        )
    ),
    array(
        'regex' => '#^/product/(?P<modelId>\d+)/category/new$#',
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
        'regex' => '#^/product/(?P<modelId>\d+)/category/(?P<categoryId>\d+)$#',
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
        'regex' => '#^/product/(?P<modelId>\d+)/category/(?P<categoryId>\d+)$#',
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
        'regex' => '#^/product/(?P<modelId>\d+)/tag/find$#',
        'model' => 'Shop_Views',
        'method' => 'tags',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Product'
        )
    ),
    array(
        'regex' => '#^/product/(?P<modelId>\d+)/tag/new$#',
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
        'regex' => '#^/product/(?P<modelId>\d+)/tag/(?P<tagId>\d+)$#',
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
        'regex' => '#^/product/(?P<modelId>\d+)/tag/(?P<tagId>\d+)$#',
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