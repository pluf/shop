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
class Order_RestAnonymousTest extends TestCase
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
    }

    /**
     *
     * @test
     */
    public function createRestTest()
    {
        $form = array(
            'title' => 'order-' . rand(),
            'full_name' => 'user-' . rand(),
            'phone' => '0917' . rand(10000000, 100000000),
            'email' => 'email' . rand(1000, 10000) . '@test.ir'
        );
        $response = $this->client->post('/shop/orders', $form);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    private function get_random_order(){
        $order = new Shop_Order();
        $order->title = 'order-' . rand();
        $order->full_name = 'user-' . rand();
        $order->phone = '0917' . rand(10000000, 100000000);
        $order->email = 'email' . rand(1000, 10000) . '@test.ir';
        return $order;
    }
    
    /**
     *
     * @test
     */
    public function getRestTest()
    {
        $item = $this->get_random_order();
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Order');
        // Get item
        $this->expectException(Pluf_Exception_Unauthorized::class);
        $response = $this->client->get('/shop/orders/' . $item->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }
    
    /**
     *
     * @test
     */
    public function getBySecureIdRestTest()
    {
        $item = $this->get_random_order();
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Order');
        // Get item
        $response = $this->client->get('/shop/orders/' . $item->secureId);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function updateRestTest()
    {
        $item = $this->get_random_order();
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Order');
        // Update item
        $form = array(
            'title' => 'new title' . rand()
        );
        $this->expectException(Pluf_Exception_Unauthorized::class);
        $response = $this->client->post('/shop/orders/' . $item->id, $form);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }
    
    /**
     *
     * @test
     */
    public function updateBySecureIdRestTest()
    {
        $item = $this->get_random_order();
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Order');
        // Update item
        $form = array(
            'title' => 'new title' . rand()
        );
        $response = $this->client->post('/shop/orders/' . $item->secureId, $form);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function deleteRestTest()
    {
        $item = $this->get_random_order();
        $item->create();
        Test_Assert::assertFalse($item->isAnonymous(), 'Could not create Shop_Order');

        $this->expectException(Pluf_Exception_Unauthorized::class);
        // delete
        $response = $this->client->delete('/shop/orders/' . $item->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function findRestTest()
    {
        $this->expectException(Pluf_Exception_Unauthorized::class);
        $response = $this->client->get('/shop/orders');
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

}



