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
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\IncompleteTestError;
require_once 'Pluf.php';

/**
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class Product_RestTest extends TestCase
{

    var $client;

    /**
     * @beforeClass
     */
    public static function createDataBase()
    {
        Pluf::start(__DIR__ . '/../conf/config.php');
        $m = new Pluf_Migration(Pluf::f('installed_apps'));
        $m->install();
        $m->init();
        
        $user = new User();
        $user->login = 'test';
        $user->first_name = 'test';
        $user->last_name = 'test';
        $user->email = 'toto@example.com';
        $user->setPassword('test');
        $user->active = true;
        if (true !== $user->create()) {
            throw new Exception();
        }
        
        $rol = Role::getFromString('Pluf.owner');
        $user->setAssoc($rol);
        
        $t = new User($user->id);
        Test_Assert::assertTrue($t->hasPerm('Pluf.owner'));
    }

    /**
     * @afterClass
     */
    public static function removeDatabses()
    {
        $m = new Pluf_Migration(Pluf::f('installed_apps'));
        $m->unInstall();
    }

    /**
     * @before
     */
    public function init()
    {
        $this->client = new Test_Client(array(
            array(
                'app' => 'Shop',
                'regex' => '#^/api/shop#',
                'base' => '',
                'sub' => include 'Shop/urls.php'
            ),
            array(
                'app' => 'User',
                'regex' => '#^/api/user#',
                'base' => '',
                'sub' => include 'User/urls.php'
            )
        ));
        // login
        $response = $this->client->post('/api/user/login', array(
            'login' => 'test',
            'password' => 'test'
        ));
    }

    /**
     * @test
     */
    public function createRestTest()
    {
        $form = array(
            'title' => 'product-' . rand(),
            'manufacturer' => 'manufacturer-' . rand(),
            'brand' => 'brand-' . rand(),
            'model' => 'model-' . rand(),
            'price' => rand(),
            'off' => '10'
        );
        $response = $this->client->post('/api/shop/product/new', $form);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     * @test
     */
    public function getRestTest()
    {
        $item = new Shop_Product();
        $item->title = 'product-' . rand();
        $item->manufacturer = 'manufacturer-' . rand();
        $item->brand = 'brand-' . rand();
        $item->model = 'model-' . rand();
        $item->price = rand();
        $item->off = 10;
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Product');
        // Get item
        $response = $this->client->get('/api/shop/product/' . $item->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     * @test
     */
    public function updateRestTest()
    {
        $item = new Shop_Product();
        $item->title = 'product-' . rand();
        $item->manufacturer = 'manufacturer-' . rand();
        $item->brand = 'brand-' . rand();
        $item->model = 'model-' . rand();
        $item->price = rand();
        $item->off = 10;
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Product');
        // Update item
        $form = array(
            'title' => 'new title' . rand()
        );
        $response = $this->client->post('/api/shop/product/' . $item->id, $form);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     * @test
     */
    public function deleteRestTest()
    {
        $item = new Shop_Product();
        $item->title = 'product-' . rand();
        $item->manufacturer = 'manufacturer-' . rand();
        $item->brand = 'brand-' . rand();
        $item->model = 'model-' . rand();
        $item->price = rand();
        $item->off = 10;
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Product');
        
        // delete
        $response = $this->client->delete('/api/shop/product/' . $item->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }
    
    /**
     * @test
     */
    public function findRestTest()
    {
        $response = $this->client->get('/api/shop/product/find');
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     * @test
     */
    public function assocProductCategoryRestTest()
    {
        $item = new Shop_Product();
        $item->title = 'product-' . rand();
        $item->manufacturer = 'manufacturer-' . rand();
        $item->brand = 'brand-' . rand();
        $item->model = 'model-' . rand();
        $item->price = rand();
        $item->off = 10;
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Product');
        
        $cat = new Assort_Category();
        $cat->name = 'category-' . rand();
        $cat->create();
        Test_Assert::assertFalse($cat->isAnonymous(), 'Could not create Assort_Category');
        
        $item->setAssoc($cat);
        
        // find
        $response = $this->client->get('/api/shop/product/' . $item->id . '/category/find');
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
        
        // create
        $response = $this->client->post('/api/shop/product/' . $item->id . '/category/new', array(
            'categoryId' => $cat->id,
        ));
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
        
        // TODO: hadi, 2018: add get method to product.url
//         // get
//         $response = $this->client->get('/api/shop/product/' . $item->id . '/category/' . $cat->id);
//         $this->assertNotNull($response);
//         $this->assertEquals($response->status_code, 200);
        
        // delete
        $response = $this->client->delete('/api/shop/product/' . $item->id . '/category/' . $cat->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     * @test
     */
    public function assocProductTagRestTest()
    {
        $item = new Shop_Product();
        $item->title = 'product-' . rand();
        $item->manufacturer = 'manufacturer-' . rand();
        $item->brand = 'brand-' . rand();
        $item->model = 'model-' . rand();
        $item->price = rand();
        $item->off = 10;
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Product');
        
        $tag = new Assort_Tag();
        $tag->name = 'tag-' . rand();
        $tag->create();
        Test_Assert::assertFalse($tag->isAnonymous(), 'Could not create Assort_Tag');
        
        $item->setAssoc($tag);
        
        // find
        $response = $this->client->get('/api/shop/product/' . $item->id . '/tag/find');
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
        
        // create
        $response = $this->client->post('/api/shop/product/' . $item->id . '/tag/new', array(
            'tagId' => $tag->id,
        ));
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
        
//         // get
//         $response = $this->client->get('/api/shop/product/' . $item->id . '/tag/' . $tag->id);
//         $this->assertNotNull($response);
//         $this->assertEquals($response->status_code, 200);
        
        // delete
        $response = $this->client->delete('/api/shop/product/' . $item->id . '/tag/' . $tag->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }
}



