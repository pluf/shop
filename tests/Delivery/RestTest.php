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
use Pluf\Test\Client;
use Pluf\Test\TestCase;

class Delivery_RestTest extends TestCase
{

    var $client;

    /**
     *
     * @beforeClass
     */
    public static function createDataBase()
    {
        Pluf::start(__DIR__ . '/../conf/config.php');
        $m = new Pluf_Migration();
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
        $m = new Pluf_Migration();
        $m->uninstall();
    }

    /**
     *
     * @before
     */
    public function init()
    {
        $this->client = new Client();
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
            'title' => 'delivery-' . rand(),
            'price' => rand(),
            'off' => '10'
        );
        $response = $this->client->post('/shop/deliveries', $form);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function getRestTest()
    {
        $item = new Shop_Delivery();
        $item->title = 'delivery-' . rand();
        $item->price = rand();
        $item->off = 10;
        $item->create();
        $this->assertFalse($item->isAnonymous(), 'Could not create Shop_Delivery');
        // Get item
        $response = $this->client->get('/shop/deliveries/' . $item->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function updateRestTest()
    {
        $item = new Shop_Delivery();
        $item->title = 'delivery-' . rand();
        $item->price = rand();
        $item->off = 10;
        $item->create();
        $this->assertFalse($item->isAnonymous(), 'Could not create Shop_Delivery');
        // Update item
        $form = array(
            'title' => 'new title' . rand()
        );
        $response = $this->client->post('/shop/deliveries/' . $item->id, $form);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function deleteRestTest()
    {
        $item = new Shop_Delivery();
        $item->title = 'delivery-' . rand();
        $item->price = rand();
        $item->off = 10;
        $item->create();
        $this->assertFalse($item->isAnonymous(), 'Could not create Shop_Delivery');

        // delete
        $response = $this->client->delete('/shop/deliveries/' . $item->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function findRestTest()
    {
        $response = $this->client->get('/shop/deliveries');
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    // /**
    // *
    // * @test
    // */
    // public function assocDeliveryCategoryRestTest()
    // {
    // $item = new Shop_Delivery();
    // $item->title = 'delivery-' . rand();
    // $item->model = 'model-' . rand();
    // $item->price = rand();
    // $item->off = 10;
    // $item->create();
    // $this->assertFalse($item->isAnonymous(), 'Could not create Shop_Delivery');

    // $cat = new Shop_Category();
    // $cat->name = 'category-' . rand();
    // $cat->create();
    // $this->assertFalse($cat->isAnonymous(), 'Could not create Shop_Category');

    // $item->setAssoc($cat);

    // // find
    // $response = $this->client->get('/shop/deliveries/' . $item->id . '/categories');
    // $this->assertNotNull($response);
    // $this->assertEquals($response->status_code, 200);

    // // create
    // $response = $this->client->post('/shop/deliveries/' . $item->id . '/categories', $cat);
    // $this->assertNotNull($response);
    // $this->assertEquals($response->status_code, 200);

    // // TODO: hadi, 2018: add get method to delivery.url
    // // // get
    // // $response = $this->client->get('/shop/delivery/' . $item->id . '/category/' . $cat->id);
    // // $this->assertNotNull($response);
    // // $this->assertEquals($response->status_code, 200);

    // // delete
    // $response = $this->client->delete('/shop/deliveries/' . $item->id . '/categories/' . $cat->id);
    // $this->assertNotNull($response);
    // $this->assertEquals($response->status_code, 200);
    // }

    // /**
    // *
    // * @test
    // */
    // public function assocDeliveryTagRestTest()
    // {
    // $item = new Shop_Delivery();
    // $item->title = 'delivery-' . rand();
    // $item->price = rand();
    // $item->off = 10;
    // $item->create();
    // $this->assertFalse($item->isAnonymous(), 'Could not create Shop_Delivery');

    // $tag = new Shop_Tag();
    // $tag->name = 'tag-' . rand();
    // $tag->create();
    // $this->assertFalse($tag->isAnonymous(), 'Could not create Shop_Tag');

    // $item->setAssoc($tag);

    // // find
    // $response = $this->client->get('/shop/deliveries/' . $item->id . '/tags');
    // $this->assertNotNull($response);
    // $this->assertEquals($response->status_code, 200);

    // // create
    // $response = $this->client->post('/shop/deliveries/' . $item->id . '/tags', $tag);
    // $this->assertNotNull($response);
    // $this->assertEquals($response->status_code, 200);

    // // // get
    // // $response = $this->client->get('/shop/delivery/' . $item->id . '/tag/' . $tag->id);
    // // $this->assertNotNull($response);
    // // $this->assertEquals($response->status_code, 200);

    // // delete
    // $response = $this->client->delete('/shop/deliveries/' . $item->id . '/tags/' . $tag->id);
    // $this->assertNotNull($response);
    // $this->assertEquals($response->status_code, 200);
    // }
}



