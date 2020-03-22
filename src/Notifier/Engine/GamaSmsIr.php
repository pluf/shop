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
class Notifier_Engine_GamaSmsIr extends Notifier_Engine
{
    const ENGINE_PARAMETER_USERNAME = 'notifier.engine.GamaSmsIr.username';
    const ENGINE_PARAMETER_PASSWORD = 'notifier.engine.GamaSmsIr.password';
    const ENGINE_PARAMETER_FROM = 'notifier.engine.GamaSmsIr.from';
    /**
     * The string [code] in the template will be replaced with the notification code. 
     * @var string
     */
    const ENGINE_PARAMETER_TEMPLATE = 'notifier.engine.GamaSmsIr.template';
    
    
    /*
     *
     */
    public function getTitle()
    {
        return 'Gama SMS (Gama Payamak)';
    }

    /*
     *
     */
    public function getDescription()
    {
        return 'This notifier sends SMS to notify an entity. This notifier uses the gamasms.ir (gamapayamak.com) panel to send messages.';
    }

    /*
     *
     */
    public function getExtraParam()
    {
        return array();
    }

    public function send($data)
    {
        $response = $this->sendSms($data);
        return $response;
    }

    private function sendSms($data)
    {
        $backend = 'https://rest.payamak-panel.com';
        $path = '/api/SendSMS/SendSMS';
        $headers = array(
            'Content-Type' => 'application/x-www-form-urlencoded'
        );
        $param = $this->initParameters($data);
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', $backend . $path, [
            'headers' => $headers,
            'form_params' => $param
        ]);
        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            throw new \Pluf\Exception($response->getBody()->getContents());
        }
        $contents = $response->getBody()->getContents();
        return json_decode($contents, true);
    }
    
    /**
     * Provides and returns needed parameters to send SMS.
     * @return array
     */
    private function initParameters($data){
        $receiver = array_key_exists('receiver', $data) ? $data['receiver'] : null;
        if (! $receiver) {
            throw new Notifier_Exception_NotificationSend('Receiver is not determined to send notification SMS.');
        }
        $username = Tenant_Service::setting(self::ENGINE_PARAMETER_USERNAME);
        $password = Tenant_Service::setting(self::ENGINE_PARAMETER_PASSWORD);
        $from = Tenant_Service::setting(self::ENGINE_PARAMETER_FROM);
        $template = Tenant_Service::setting(self::ENGINE_PARAMETER_TEMPLATE);
        // TODO: hadi, 1398-11: use mustache template to create message text
        $code = array_key_exists('code', $data) ? $data['code'] : '';
        $text = str_replace('[code]', $code, $template);
        $param = array(
            'username' => $username,
            'password' => $password,
            'from' => $from,
            'to' => $receiver,
            'text' => $text,
            'isFlash' => false
        );
        return $param;
    }
}
