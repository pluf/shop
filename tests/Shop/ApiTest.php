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

class Shop_ApiTest extends TestCase
{

    /**
     * @before
     */
    public function setUpTest ()
    {
        Pluf::start(__DIR__. '/../conf/config.php');
    }

    /**
     * @test
     */
    public function testClassInstance ()
    {
        $models = array(
            'Shop_Product',
            'Shop_ProductMetafield',
            'Shop_Service',
            'Shop_ServiceMetafield',
            'Shop_Order',
            'Shop_OrderMetafield',
            'Shop_OrderHistory',
            'Shop_OrderItem',
            'Shop_Address',
            'Shop_Zone',
            'Shop_Agency',
            'Shop_Contact',
            'Shop_Delivery',
            'Shop_TaxClass'
        );
        
        foreach ($models as $model){
            $object = new $model();
            $this->assertTrue(isset($object), "$model could not be created!");
        }
    }
}

