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

class Categories_MetafieldsRestTest extends TestCase
{

    var $client;

    var $anonymousClient;

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
            throw new Pluf_Exception();
        }
        // Credential of user
        $credit = new User_Credential();
        $credit->setFromFormData(array(
            'account_id' => $user->id
        ));
        $credit->setPassword('test');
        if (true !== $credit->create()) {
            throw new Pluf_Exception();
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

        // Anonymous Client
        $this->anonymousClient = new Client();
    }

    private function get_random_category()
    {
        $category = new Shop_Category();
        $category->name = 'category-' . rand();
        $category->description = 'a test catego' . rand();
        return $category;
    }

    /**
     *
     * @test
     */
    public function metafieldCrudRestTest()
    {
        $item = $this->get_random_category();
        $item->create();
        $this->assertFalse($item->isAnonymous(), 'Could not create Shop_Category');

        $metafield = array(
            'key' => 'key-' . rand(),
            'value' => 'value-' . rand()
        );

        // create
        $response = $this->client->post('/shop/categories/' . $item->id . '/metafields', $metafield);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
        $actual = json_decode($response->content, true);
        $this->assertEquals($actual['key'], $metafield['key']);
        $this->assertEquals($actual['value'], $metafield['value']);
        $id = $actual['id'];
        // find
        $response = $this->client->get('/shop/categories/' . $item->id . '/metafields');
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
        // Update
        $metafield['key'] = 'updated-key-' . rand();
        $metafield['value'] = 'updated-value-' . rand();
        $response = $this->client->post('/shop/categories/' . $item->id . '/metafields/' . $id, $metafield);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
        $actual = json_decode($response->content, true);
        $this->assertEquals($actual['id'], $id);
        $this->assertEquals($actual['key'], $metafield['key']);
        $this->assertEquals($actual['value'], $metafield['value']);
        // delete
        $response = $this->client->delete('/shop/categories/' . $item->id . '/metafields/' . $id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function metafieldCrudByKeyRestTest()
    {
        $item = $this->get_random_category();
        $item->create();
        $this->assertFalse($item->isAnonymous(), 'Could not create Shop_Category');

        $metafield = array(
            'key' => 'key-' . rand(),
            'value' => 'value-' . rand()
        );

        // create
        $response = $this->client->post('/shop/categories/' . $item->id . '/metafields', $metafield);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
        $actual = json_decode($response->content, true);
        $this->assertEquals($actual['key'], $metafield['key']);
        $this->assertEquals($actual['value'], $metafield['value']);
        $key = $actual['key'];
        // Read
        $response = $this->client->get('/shop/categories/' . $item->id . '/metafields/' . $key);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
        $actual = json_decode($response->content, true);
        $this->assertEquals($actual['key'], $metafield['key']);
        $this->assertEquals($actual['value'], $metafield['value']);
        // Update
        $metafield['key'] = 'updated-key-' . rand();
        $metafield['value'] = 'updated-value-' . rand();
        $response = $this->client->post('/shop/categories/' . $item->id . '/metafields/' . $key, $metafield);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
        $actual = json_decode($response->content, true);
        $this->assertEquals($actual['key'], $metafield['key']);
        $this->assertEquals($actual['value'], $metafield['value']);
    }
}



