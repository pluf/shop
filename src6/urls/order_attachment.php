<?php
/*
 * This file is part of Pluf Framework, a simple PHP Application Framework.
 * Copyright (C) 2010-2020 Phoinex Scholars Co. (http://dpq.co.ir)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/order-attachments/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Shop_OrderAttachment'
        )
    ),
    // ************************************************************* Order Attachment
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
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read
        'regex' => '#^/orders/(?P<parentId>\d+)/attachments/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Update
        'regex' => '#^/orders/(?P<parentId>\d+)/attachments/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/orders/(?P<parentId>\d+)/attachments/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* Order Attachment (by secure id)
    array( // Create
        'regex' => '#^/orders/(?P<secureId>[^/]+)/attachments$#',
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'create',
        'http-method' => 'POST'
    ),
    array( // Read (list)
        'regex' => '#^/orders/(?P<secureId>[^/]+)/attachments$#',
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Read
        'regex' => '#^/orders/(?P<secureId>[^/]+)/attachments/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update
        'regex' => '#^/orders/(?P<secureId>[^/]+)/attachments/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'update',
        'http-method' => 'POST'
    ),
    array( // Delete
        'regex' => '#^/orders/(?P<secureId>[^/]+)/attachments/(?P<modelId>\d+)$#',
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'delete',
        'http-method' => 'DELETE'
    ),
    // ************************************************************* Binary content of attachment
    array( // Read
        'regex' => '#^/orders/(?P<orderId>\d+)/attachments/(?P<modelId>\d+)/content$#',
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'download',
        'http-method' => 'GET',
        // Cache apram
        'cacheable' => true,
        'revalidate' => true,
        'intermediate_cache' => true,
        'max_age' => 25000,
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Update
        'regex' => '#^/orders/(?P<orderId>\d+)/attachments/(?P<modelId>\d+)/content$#',
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'upload',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* Binary content of attachment (by secure id)
    array( // Read
        'regex' => '#^/orders/(?P<secureId>[^/]+)/attachments/(?P<modelId>\d+)/content$#',
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'download',
        'http-method' => 'GET',
        // Cache apram
        'cacheable' => true,
        'revalidate' => true,
        'intermediate_cache' => true,
        'max_age' => 25000
    ),
    array( // Update
        'regex' => '#^/orders/(?P<secureId>[^/]+)/attachments/(?P<modelId>\d+)/content$#',
        'model' => 'Shop_Views_OrderAttachment',
        'method' => 'upload',
        'http-method' => 'POST'
    )
);


