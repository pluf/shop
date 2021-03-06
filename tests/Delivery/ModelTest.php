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
 * You should have received a copy of the GNU Gneral Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
use Pluf\Test\TestCase;

class Delivery_ModelTest extends TestCase
{

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

    private function get_random_delivery()
    {
        $delivery = new Shop_Delivery();
        $delivery->title = 'delivery-' . rand();
        $delivery->price = 20000;
        return $delivery;
    }

    /**
     *
     * @test
     */
    public function shouldPossibleCreateNew()
    {
        $delivery = $this->get_random_delivery();
        $this->assertTrue($delivery->create(), 'Impossible to create delivery');
    }

    /**
     *
     * @test
     */
    public function shouldPossibleToGetCategories()
    {
        $delivery = $this->get_random_delivery();
        $this->assertTrue($delivery->create(), 'Impossible to create delivery');

        $delivery = new Shop_Delivery($delivery->id);
        $cats = $delivery->get_categories_list();
        $this->assertEquals(0, $cats->count());
    }

    /**
     *
     * @test
     */
    public function shouldPossibleToGetTags()
    {
        $delivery = $this->get_random_delivery();
        $this->assertTrue($delivery->create(), 'Impossible to create delivery');

        $delivery = new Shop_Delivery($delivery->id);
        $tags = $delivery->get_tags_list();
        $this->assertEquals(0, $tags->count());
    }
}


