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
 *
 * @author hadi
 *        
 */
class Notifier_Service
{

    /**
     * Sends a notification.
     *
     * @param array $data
     */
    public static function sendNotification($data)
    {
        // Get engine
        // Send notification
    }

    /**
     * Find engine
     *
     * @param string $type
     * @return Notifier_Engine engine
     */
    public static function getEngine($type)
    {
        $items = self::engines();
        foreach ($items as $item) {
            if ($item->getType() === $type) {
                return $item;
            }
        }
        return null;
    }

    /**
     * Returns the list of supported notification engines.
     *
     * @return array the list of the supported notification engines.
     */
    public static function engines()
    {
        return array(
            new Notifier_Engine_NoNotify(),
            new Notifier_Engine_SmsIr(),
            new Notifier_Engine_GamaSmsIr()
        );
    }
}