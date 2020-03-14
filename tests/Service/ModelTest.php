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
use Pluf\Test\TestCase;
use Pluf\Test\Test_Assert;

class Service_ModelTest extends TestCase
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

    private function get_random_service()
    {
        $service = new Shop_Service();
        $service->title = 'service-' . rand();
        $service->price = 20000;
        return $service;
    }

    /**
     *
     * @test
     */
    public function shouldPossibleCreateNew()
    {
        $service = $this->get_random_service();
        $this->assertTrue($service->create(), 'Impossible to create service');
    }

    /**
     *
     * @test
     */
    public function shouldPossibleToGetCategories()
    {
        $service = $this->get_random_service();
        $this->assertTrue($service->create(), 'Impossible to create service');

        $service = new Shop_Service($service->id);
        $cats = $service->get_categories_list();
        $this->assertEquals(0, $cats->count());
    }

    /**
     *
     * @test
     */
    public function shouldPossibleToGetTags()
    {
        $service = $this->get_random_service();
        $this->assertTrue($service->create(), 'Impossible to create service');

        $service = new Shop_Service($service->id);
        $tags = $service->get_tags_list();
        $this->assertEquals(0, $tags->count());
    }

    /**
     *
     * @test
     */
    public function shouldPossibleToGetTaxes()
    {
        $service = $this->get_random_service();
        $this->assertTrue($service->create(), 'Impossible to create service');

        $service = new Shop_Service($service->id);
        $taxes = $service->get_taxes_list();
        $this->assertEquals(0, $taxes->count());
    }
}


