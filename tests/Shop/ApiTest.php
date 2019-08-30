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

require_once 'Pluf.php';

/**
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
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
        $object = new Shop_Product();
        $this->assertTrue(isset($object), 'Shop_Product could not be created!');
        $object = new Shop_ProductMetafield();
        $this->assertTrue(isset($object), 'Shop_ProductMetafield could not be created!');
        $object = new Shop_Service();
        $this->assertTrue(isset($object), 'Shop_Service could not be created!');
        $object = new Shop_ServiceMetafield();
        $this->assertTrue(isset($object), 'Shop_ServiceMetafield could not be created!');
        $object = new Shop_Order();
        $this->assertTrue(isset($object), 'Shop_Order could not be created!');
        $object = new Shop_OrderHistory();
        $this->assertTrue(isset($object), 'Shop_OrderHistory could not be created!');
        $object = new Shop_OrderItem();
        $this->assertTrue(isset($object), 'Shop_OrderItem could not be created!');
        $object = new Shop_Address();
        $this->assertTrue(isset($object), 'Shop_Address could not be created!');
        $object = new Shop_Zone();
        $this->assertTrue(isset($object), 'Shop_Zone could not be created!');
        $object = new Shop_Agency();
        $this->assertTrue(isset($object), 'Shop_Agency could not be created!');
        $object = new Shop_Contact();
        $this->assertTrue(isset($object), 'Shop_Contact could not be created!');
        $object = new Shop_Delivery();
        $this->assertTrue(isset($object), 'Shop_Delivery could not be created!');
        $object = new Shop_TaxClass();
        $this->assertTrue(isset($object), 'Shop_TaxClass could not be created!');
        
    }
}

