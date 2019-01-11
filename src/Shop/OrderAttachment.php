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
 * OrderAttachment data model
 *
 * @author hadi <mohammad.hadi.mansouri@dpq.co.ir>
 * @author maso <mostafa.barmshory@dpq.co.ir>
 *        
 */
class Shop_OrderAttachment extends Pluf_Model
{

    /**
     * مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'shop_order_attachments';
        $this->_a['cols'] = array(
            // شناسه‌ها
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => false,
                'verbose' => 'first name',
                'help_text' => 'id',
                'editable' => false
            ),
            'description' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 2048,
                'default' => 'auto created content',
                'verbose' => 'description',
                'help_text' => 'content description',
                'editable' => true
            ),
            'mime_type' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 64,
                'default' => 'application/octet-stream',
                'verbose' => 'mime type',
                'help_text' => 'content mime type',
                'editable' => true
            ),
            'file_path' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 250,
                'verbose' => 'File path',
                'help_text' => 'OrderAttachment file path',
                'editable' => false,
                'readable' => false
            ),
            'file_name' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 250,
                'default' => 'unknown',
                'verbose' => 'file name',
                'help_text' => 'OrderAttachment file name',
                'editable' => false
            ),
            'file_size' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'default' => 'no title',
                'verbose' => 'file size',
                'help_text' => 'content file size',
                'editable' => false
            ),
            /*
             * Relations
             */
            'order_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Shop_Order',
                'name' => 'order',
                'graphql_name' => 'order',
                'relate_name' => 'attachments',
                'blank' => false,
                'editable' => false,
                'readable' => true
            )
        );
    }

    /**
     * پیش ذخیره را انجام می‌دهد
     *
     * @param boolean $create
     *            حالت
     *            ساخت یا به روز رسانی را تعیین می‌کند
     */
    function preSave($create = false)
    {
        // File path
        $path = $this->getAbsloutPath();
        // file size
        if (file_exists($path)) {
            $this->file_size = filesize($path);
        } else {
            $this->file_size = 0;
        }
        // mime type (based on file name)
        $mime_type = $this->mime_type;
        if(!isset($mime_type) || $mime_type === 'application/octet-stream'){
            $fileInfo = Pluf_FileUtil::getMimeType($this->file_name);
            $this->mime_type = $fileInfo[0];
        }
    }

    /**
     * حالت کار ایجاد شده را به روز می‌کند
     *
     * @see Pluf_Model::postSave()
     */
    function postSave($create = false)
    {
        //
    }

    /**
     * \brief عملیاتی که قبل از پاک شدن است انجام می‌شود
     *
     * عملیاتی که قبل از پاک شدن است انجام می‌شود
     * در این متد فایل مربوط به است حذف می شود. این عملیات قابل بازگشت نیست
     */
    function preDelete()
    {
        // remove related file
        $filename = $this->file_path . '/' . $this->id;
        if (is_file($filename)) {
            unlink($filename);
        }
    }

    /**
     * مسیر کامل محتوی را تعیین می‌کند.
     *
     * @return string
     */
    public function getAbsloutPath()
    {
        return $this->file_path . '/' . $this->id;
    }
}