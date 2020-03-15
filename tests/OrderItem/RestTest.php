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

class OrderItem_RestTest extends TestCase
{

    var $client;

    private $product;

    private $order;

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
        $this->client->post('/user/login', array(
            'login' => 'test',
            'password' => 'test'
        ));
        // product
        $this->product = new Shop_Product();
        $this->product->manufacturer = 'manufacturer-' . rand();
        $this->product->brand = 'brand-' . rand();
        $this->product->model = 'model-' . rand();
        $this->product->price = 20000;
        $this->product->create();

        // order
        $this->order = new Shop_Order();
        $this->order->title = 'order-' . rand();
        $this->order->full_name = 'user-' . rand();
        $this->order->phone = '0917' . rand(10000000, 100000000);
        $this->order->email = 'email' . rand(1000, 10000) . '@test.ir';
        $this->order->create();
    }

    /**
     *
     * @test
     */
    public function createRestTest()
    {
        $form = array(
            'item_id' => $this->product->id,
            'item_type' => 'product',
            'count' => rand(1, 10)
        );
        $response = $this->client->post('/shop/orders/' . $this->order->id . '/items', $form);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    private function get_random_orderItem()
    {
        $item = new Shop_OrderItem();
        $item->item_id = $this->product->id;
        $item->item_type = 'product';
        $item->count = rand(1, 10);
        $item->order_id = $this->order;
        return $item;
    }

    /**
     *
     * @test
     */
    public function getRestTest()
    {
        $item = $this->get_random_orderItem();
        $item->create();
        $this->assertFalse($item->isAnonymous(), 'Could not create Shop_OrderItem');
        // Get item
        $response = $this->client->get('/shop/orders/' . $this->order->id . '/items/' . $item->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function updateRestTest()
    {
        $item = $this->get_random_orderItem();
        $item->create();
        $this->assertFalse($item->isAnonymous(), 'Could not create Shop_OrderItem');
        // Update item
        $form = array(
            'count' => rand(1, 10)
        );
        $response = $this->client->post('/shop/orders/' . $this->order->id . '/items/' . $item->id, $form);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function deleteRestTest()
    {
        $item = $this->get_random_orderItem();
        $item->create();
        $this->assertFalse($item->isAnonymous(), 'Could not create Shop_OrderItem');

        // delete
        $response = $this->client->delete('/shop/orders/' . $this->order->id . '/items/' . $item->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function findRestTest()
    {
        $response = $this->client->get('/shop/orders/' . $this->order->id . '/items');
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }
}



