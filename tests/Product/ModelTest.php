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

class Product_ModelTest extends TestCase
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

    /**
     *
     * @test
     */
    public function shouldPossibleCreateNew()
    {
        $product = new Shop_Product();
        $product->manufacturer = 'manufacturer-' . rand();
        $product->brand = 'brand-' . rand();
        $product->model = 'model-' . rand();
        $product->price = 20000;
        $this->assertTrue($product->create(), 'Impossible to create product');
    }

    /**
     *
     * @test
     */
    public function shouldPossibleToGetCategories()
    {
        $product = new Shop_Product();
        $product->manufacturer = 'manufacturer-' . rand();
        $product->brand = 'brand-' . rand();
        $product->model = 'model-' . rand();
        $product->price = 20000;
        $this->assertTrue($product->create(), 'Impossible to create product');

        $product = new Shop_Product($product->id);
        $cats = $product->get_categories_list();
        $this->assertEquals(0, $cats->count());
    }

    /**
     *
     * @test
     */
    public function shouldPossibleToGetTags()
    {
        $product = new Shop_Product();
        $product->manufacturer = 'manufacturer-' . rand();
        $product->brand = 'brand-' . rand();
        $product->model = 'model-' . rand();
        $product->price = 20000;
        $this->assertTrue($product->create(), 'Impossible to create product');

        $product = new Shop_Product($product->id);
        $tags = $product->get_tags_list();
        $this->assertEquals(0, $tags->count());
    }

    /**
     *
     * @test
     */
    public function shouldPossibleToGetTaxes()
    {
        $product = new Shop_Product();
        $product->manufacturer = 'manufacturer-' . rand();
        $product->brand = 'brand-' . rand();
        $product->model = 'model-' . rand();
        $product->price = 20000;
        $this->assertTrue($product->create(), 'Impossible to create product');

        $product = new Shop_Product($product->id);
        $taxes = $product->get_taxes_list();
        $this->assertEquals(0, $taxes->count());
    }
}


