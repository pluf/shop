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

Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');

/**
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class Order_ModelTest extends TestCase
{
    /**
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
     * @afterClass
     */
    public static function removeDatabses()
    {
        $m = new Pluf_Migration(Pluf::f('installed_apps'));
        $m->unInstall();
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
     * @test
     */
    public function shouldPossibleCreateNew()
    {
        $order = $this->get_random_order();
        Test_Assert::assertTrue($order->create(), 'Impossible to create order');
    }

    /**
     * @test
     */
    public function getPossibleTransitions()
    {
        $order = $this->get_random_order();
        Test_Assert::assertTrue($order->create(), 'Impossible to create order');
        
        // Initial by order-manager
        $manager = $order->getManager();
        $manager->apply($order, 'create');
        
        $order = new Shop_Order($order->id);
        $trans = $order->getManager()->transitions($order);
        Test_Assert::assertNotNull($trans);
    }
    
    /**
     * @test
     */
    public function shouldPossibleToGetOrderitems()
    {
        $order = $this->get_random_order();
        Test_Assert::assertTrue($order->create(), 'Impossible to create order');
        
        $oitems = $order->get_order_item_list();
        Test_Assert::assertEquals(0, $oitems->count());
    }
    
}


