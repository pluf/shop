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

/**
 * Shop standard pre-condetions
 *
 * Preconditions to access entities in the shop is defined here.
 */
class Shop_Precondition
{

    /**
     * Returns true if user (sending request) can view information of the order.
     *
     * The creator of an order (customer who registers the order) or owner of tenant
     * can view the information of the order
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $order
     * @return boolean
     */
    public static function canViewOrder($request, $order)
    {
        if (User_Precondition::isOwner($request)) {
            return true;
        }
        if (isset($request->user) && $request->user->id === $order->customer_id) {
            return true;
        }
        return false;
    }

    /**
     * Returns true if user (sending request) can modify information of the order.
     *
     * Only the creator of an order (customer who registers the order) can modify the order
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $order
     * @return boolean
     */
    public static function canModifyOrder($request, $order)
    {
        if (isset($request->user) && $request->user->id === $order->customer_id) {
            return true;
        }
        return false;
    }
}


