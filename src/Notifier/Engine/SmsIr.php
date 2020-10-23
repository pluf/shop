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
class Notifier_Engine_SmsIr extends Notifier_Engine
{
    const ENGINE_PARAMETER_API_KEY = 'notifier.engine.SmsIr.ApiKey';
    const ENGINE_PARAMETER_SECRET_KEY = 'notifier.engine.SmsIr.SecretKey';
    
    /*
     *
     */
    public function getTitle()
    {
        return 'SMS IR';
    }

    /*
     *
     */
    public function getDescription()
    {
        return 'This notifier sends SMS to notify an entity. This notifier uses the sms.ir panel to send messages.';
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
        // Send SMS
        $response = $this->sendSms($data);
        return $response;
    }

    private function getToken()
    {
        $backend = 'http://RestfulSms.com';
        $path = '/api/Token';
        $apiKey = Tenant_Service::setting(self::ENGINE_PARAMETER_API_KEY, '');
        $secKey = Tenant_Service::setting(self::ENGINE_PARAMETER_SECRET_KEY, '');
        $param = array(
            'UserApiKey' => $apiKey,
            'SecretKey' => $secKey
        );
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', $backend . $path, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($param)
        ]);
        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            throw new Notifier_Exception_NotificationSend($response->getBody()->getContents());
        }
        $contents = $response->getBody()->getContents();
        $result = json_decode($contents, true);
        return $result['TokenKey'];
    }

    private function sendSms($data)
    {
        // Mobile number
        $receiver = array_key_exists('receiver', $data) ? $data['receiver'] : null;
        if (! $receiver) {
            throw new Notifier_Exception_NotificationSend('Phone is not determined to send notification SMS.');
        }
        // Code
        $code = array_key_exists('code', $data) ? $data['code'] : '';
        // Get token
        $token = $this->getToken();
        
        $backend = 'http://RestfulSms.com';
        $headers = array(
            'x-sms-ir-secure-token' => $token,
            'Content-Type' => 'application/json'
        );
        $templateId = array_key_exists('messageId', $data) ? $data['messageId'] : 0;
        $path = $templateId > 0 ? '/api/UltraFastSend' : '/api/VerificationCode';
        $param = array();
        if ($templateId > 0) {
            $param['Mobile'] = $receiver;
            $param['TemplateId'] = $templateId;
            $param['ParameterArray'] = array(
                array(
                    'Parameter' => 'NotificationCode',
                    'ParameterValue' => $code
                )
            );
        } else {
            $param['MobileNumber'] = $receiver;
            $param['Code'] = $code;
        }
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', $backend . $path, [
            'headers' => $headers,
            'body' => json_encode($param)
        ]);
        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            throw new \Pluf\Exception($response->getBody()->getContents());
        }
        $contents = $response->getBody()->getContents();
        return json_decode($contents, true);
    }
}
