<?php
return array(
    // ************************************************************* Product
    array( // Find
        'regex' => '#^/product/find$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_Product',
            'listFilters' => array(
                'id',
                'title',
                'price',
                'off',
                'manufacturer',
                'brand',
                'model'
            ),
            'searchFields' => array(
                'title',
                'description',
                'manufacturer',
                'brand',
                'model'
            ),
            'sortFields' => array(
                'id',
                'title',
                'price',
                'off',
                'manufacturer',
                'brand',
                'model'
            )
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
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
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
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
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
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
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
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/product/(?P<productId>\d+)/tax/(?P<taxId>\d+)$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'addProductTax',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/product/(?P<productId>\d+)/tax/(?P<taxId>\d+)$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'removeProductTax',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
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
        ),
    ),
    array(
        'regex' => '#^/product/(?P<modelId>\d+)/tag/new$#',
        'model' => 'Shop_Views',
        'method' => 'addTag',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Product'
        ),
    ),
    array(
        'regex' => '#^/product/(?P<modelId>\d+)/tag/(?P<tagId>\d+)$#',
        'model' => 'Shop_Views',
        'method' => 'addTag',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Product'
        ),
    ),
    array(
        'regex' => '#^/product/(?P<modelId>\d+)/tag/(?P<tagId>\d+)$#',
        'model' => 'Shop_Views',
        'method' => 'removeTag',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Product'
        ),
    ),
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
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
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
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
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
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),// ************************************************************* Taxes of Service
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
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/service/(?P<serviceId>\d+)/tax/(?P<taxId>\d+)$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'addServiceTax',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array(
        'regex' => '#^/service/(?P<serviceId>\d+)/tax/(?P<taxId>\d+)$#',
        'model' => 'Shop_Views_Tax',
        'method' => 'removeServiceTax',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
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
        ),
    ),
    array(
        'regex' => '#^/service/(?P<modelId>\d+)/tag/new$#',
        'model' => 'Shop_Views',
        'method' => 'addTag',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Service'
        ),
    ),
    array(
        'regex' => '#^/service/(?P<modelId>\d+)/tag/(?P<tagId>\d+)$#',
        'model' => 'Shop_Views',
        'method' => 'addTag',
        'http-method' => 'POST',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Service'
        ),
    ),
    array(
        'regex' => '#^/service/(?P<modelId>\d+)/tag/(?P<tagId>\d+)$#',
        'model' => 'Shop_Views',
        'method' => 'removeTag',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Shop_Service'
        ),
    ),
    // ************************************************************* TaxClass
    array( // Find
        'regex' => '#^/tax/find$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_TaxClass',
            'listFilters' => array(
                'id',
                'title',
                'rate'
            ),
            'searchFields' => array(
                'title',
                'rate'
            ),
            'sortFields' => array(
                'id',
                'title',
                'rate'
            )
        )
    ),
    array( // Create
        'regex' => '#^/tax/new$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_TaxClass'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Get info
        'regex' => '#^/tax/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_TaxClass'
        )
    ),
    array( // Delete
        'regex' => '#^/tax/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Shop_TaxClass',
            'permanently' => true
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Update
        'regex' => '#^/tax/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Shop_TaxClass'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
);