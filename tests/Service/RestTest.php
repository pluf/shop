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
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class Service_RestTest extends TestCase
{

    var $client;

    /**
     *
     * @beforeClass
     */
    public static function createDataBase()
    {
        Pluf::start(__DIR__ . '/../conf/config.php');
        $m = new Pluf_Migration(Pluf::f('installed_apps'));
        $m->install();
        $m->init();

        // Test user
        $user = new User_Account();
        $user->login = 'test';
        $user->is_active = true;
        if (true !== $user->create()) {
            throw new Exception();
        }
        // Credential of user
        $credit = new User_Credential();
        $credit->setFromFormData(array(
            'account_id' => $user->id
        ));
        $credit->setPassword('test');
        if (true !== $credit->create()) {
            throw new Exception();
        }

        $per = User_Role::getFromString('tenant.owner');
        $user->setAssoc($per);
    }

    /**
     *
     * @afterClass
     */
    public static function removeDatabses()
    {
        $m = new Pluf_Migration(Pluf::f('installed_apps'));
        $m->unInstall();
    }

    /**
     *
     * @before
     */
    public function init()
    {
        $this->client = new Test_Client(array(
            array(
                'app' => 'Shop',
                'regex' => '#^/shop#',
                'base' => '',
                'sub' => include 'Shop/urls.php'
            ),
            array(
                'app' => 'User',
                'regex' => '#^/user#',
                'base' => '',
                'sub' => include 'User/urls.php'
            )
        ));
        // login
        $response = $this->client->post('/user/login', array(
            'login' => 'test',
            'password' => 'test'
        ));
    }

    /**
     *
     * @test
     */
    public function createRestTest()
    {
        $form = array(
            'title' => 'service-' . rand(),
            'price' => rand(),
            'off' => '10'
        );
        $response = $this->client->post('/shop/services', $form);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function getRestTest()
    {
        $item = new Shop_Service();
        $item->title = 'service-' . rand();
        $item->price = rand();
        $item->off = 10;
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Service');
        // Get item
        $response = $this->client->get('/shop/services/' . $item->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function updateRestTest()
    {
        $item = new Shop_Service();
        $item->title = 'service-' . rand();
        $item->price = rand();
        $item->off = 10;
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Service');
        // Update item
        $form = array(
            'title' => 'new title' . rand()
        );
        $response = $this->client->post('/shop/services/' . $item->id, $form);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function deleteRestTest()
    {
        $item = new Shop_Service();
        $item->title = 'service-' . rand();
        $item->price = rand();
        $item->off = 10;
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Service');

        // delete
        $response = $this->client->delete('/shop/services/' . $item->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function findRestTest()
    {
        $response = $this->client->get('/shop/services');
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function assocServiceCategoryRestTest()
    {
        $item = new Shop_Service();
        $item->title = 'service-' . rand();
        $item->model = 'model-' . rand();
        $item->price = rand();
        $item->off = 10;
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Service');

        $cat = new Shop_Category();
        $cat->name = 'category-' . rand();
        $cat->create();
        Test_Assert::assertFalse($cat->isAnonymous(), 'Could not create Shop_Category');

        $item->setAssoc($cat);

        // find
        $response = $this->client->get('/shop/services/' . $item->id . '/categories');
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);

        // create
        $response = $this->client->post('/shop/services/' . $item->id . '/categories', $cat);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);

        // TODO: hadi, 2018: add get method to service.url
        // // get
        // $response = $this->client->get('/shop/service/' . $item->id . '/category/' . $cat->id);
        // $this->assertNotNull($response);
        // $this->assertEquals($response->status_code, 200);

        // delete
        $response = $this->client->delete('/shop/services/' . $item->id . '/categories/' . $cat->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function assocServiceTagRestTest()
    {
        $item = new Shop_Service();
        $item->title = 'service-' . rand();
        $item->price = rand();
        $item->off = 10;
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Service');

        $tag = new Shop_Tag();
        $tag->name = 'tag-' . rand();
        $tag->create();
        Test_Assert::assertFalse($tag->isAnonymous(), 'Could not create Shop_Tag');

        $item->setAssoc($tag);

        // find
        $response = $this->client->get('/shop/services/' . $item->id . '/tags');
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);

        // create
        $response = $this->client->post('/shop/services/' . $item->id . '/tags', $tag);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);

        // // get
        // $response = $this->client->get('/shop/service/' . $item->id . '/tag/' . $tag->id);
        // $this->assertNotNull($response);
        // $this->assertEquals($response->status_code, 200);

        // delete
        $response = $this->client->delete('/shop/services/' . $item->id . '/tags/' . $tag->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }
}



