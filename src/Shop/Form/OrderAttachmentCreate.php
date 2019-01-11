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

Pluf::loadFunction('Shop_Shortcuts_CleanName');

/**
 * 
 * @author hadi <mohammad.hadi.mansouri@dpq.co.ir>
 *
 */
class Shop_Form_OrderAttachmentCreate extends Pluf_Form_Model
{

    public $tenant = null;
    public $user = null;

    public function initFields ($extra = array())
    {
        $this->tenant = Pluf_Tenant::current();
        parent::initFields($extra);       
    }

    
    function save ($commit = true)
    {
        if (! $this->isValid()) {
            throw new Pluf_Exception_Form(
                    'cannot save the content from an invalid form', $this);
        }
        // Create the content
        $content = new Shop_OrderAttachment();
        $content->setFromFormData($this->cleaned_data);
        $content->file_path = Pluf::f('upload_path') . '/' . $this->tenant->id .
                 '/shop-order-attachment';
        if (! is_dir($content->file_path)) {
            if (false == @mkdir($content->file_path, 0777, true)) {
                throw new Pluf_Form_Invalid(
                        'An error occured when creating the upload path. Please try to send the file again.');
            }
        }
        $content->tenant = $this->tenant;
        if ($commit) {
            $content->create();
        }
        return $content;
    }
}
