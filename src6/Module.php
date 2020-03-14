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
namespace Pluf\Shop;

use Pluf;
use Pluf_Signal;

class Module extends \Pluf\Module
{

    const moduleJsonPath = __DIR__ . '/module.json';

    const relations = array(
        'Shop_Address' => array(
            'relate_to_many' => array(
                'User_Account'
            )
        ),
        'Shop_Agency' => array(
            'relate_to_many' => array(
                'User_Account'
            ),
            'relate_to' => array()
        ),
        'Shop_Contact' => array(
            'relate_to_many' => array(
                'User_Account'
            )
        ),
        'Shop_Delivery' => array(
            'relate_to_many' => array(
                'Shop_Category',
                'Shop_Tag'
            )
        ),
        'Shop_Order' => array(
            'relate_to' => array(
                'User_Account',
                'Bank_Receipt',
                'Shop_Delivery',
                'Shop_Zone',
                'Shop_Agency'
            )
        ),
        'Shop_OrderMetafield' => array(
            'relate_to' => array(
                'Shop_Order'
            )
        ),
        'Shop_OrderItem' => array(
            'relate_to' => array(
                'Shop_Order'
            )
        ),
        'Shop_OrderItemMetafield' => array(
            'relate_to' => array(
                'Shop_OrderItem'
            )
        ),
        'Shop_OrderHistory' => array(
            'relate_to' => array(
                'Shop_Order'
            )
        ),
        'Shop_OrderAttachment' => array(
            'relate_to' => array(
                'Shop_Order'
            )
        ),
        'Shop_Product' => array(
            'relate_to_many' => array(
                'Shop_TaxClass',
                'Shop_Category',
                'Shop_Tag'
            )
        ),
        'Shop_Service' => array(
            'relate_to_many' => array(
                'Shop_TaxClass',
                'Shop_Category',
                'Shop_Tag'
            )
        ),
        'Shop_Zone' => array(
            'relate_to' => array(
                'User_Account'
            ),
            'relate_to_many' => array(
                'User_Account'
            )
        ),
        'Shop_Category' => array(
            // NOTE: hadi, 1396-03: commented to avoid casecade deleting *****
            // XXX: maso, 2019: we must remove cascade delete from biz
            'relate_to' => array(
                'Shop_Category'
            )
        ),
        'Shop_CategoryMetafield' => array(
            'relate_to' => array(
                'Shop_Category'
            )
        ),
        'Shop_ProductMetafield' => array(
            'relate_to' => array(
                'Shop_Product'
            )
        ),
        'Shop_ServiceMetafield' => array(
            'relate_to' => array(
                'Shop_Service'
            )
        ),
        'Shop_Tag' => array()
    );

    public function init(Pluf $bootstrap): void
    {
        Pluf_Signal::connect('Shop_Order::stateChange', array(
            'Shop_Order_Manager_Abstract',
            'addOrderHistory'
        ));
    }
}

