<?php
/*
 * This file is part of Pluf Framework, a simple PHP Application Framework.
 * Copyright (C) 2010-2020 Phoinex Scholars Co. http://dpq.co.ir
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
Pluf::loadFunction('Pluf_HTTP_URL_urlForView');

/**
 * فرم به روز رسانی اطلاعات فروشگاه را ایجاد می‌کند.
 */
class Shop_Form_Profile extends Pluf_Form
{

    public $shop_data = null;

    /**
     * مقدار دهی فیلدها.
     *
     * @see Pluf_Form::initFields()
     */
    public function initFields($extra = array())
    {
        if (array_key_exists('shop', $extra))
            $this->shop_data = $extra['shop'];
        if ($this->shop_data == null || ! isset($this->shop_data))
            $this->shop_data = new Shop_Profile();
        
        $this->fields['name'] = new Pluf_Form_Field_Varchar(array(
            'required' => true,
            'initial' => $this->shop_data->name
        ));
        
        $this->fields['province'] = new Pluf_Form_Field_Varchar(array(
            'required' => true,
            'initial' => $this->shop_data->province
        ));
        
        $this->fields['city'] = new Pluf_Form_Field_Varchar(array(
            'required' => true,
            'initial' => $this->shop_data->city
        ));
        
        $this->fields['address'] = new Pluf_Form_Field_Varchar(array(
            'required' => false,
            'initial' => $this->shop_data->address
        ));
        
        $this->fields['phone'] = new Pluf_Form_Field_Varchar(array(
            'required' => false,
            'initial' => $this->shop_data->phone
        ));
        
        $this->fields['image'] = new Pluf_Form_Field_Varchar(array(
            'required' => false,
            'initial' => $this->shop_data->image
        ));
        
        $this->fields['point'] = new Geo_Form_Field_Point(array(
            'required' => false,
            'initial' => $this->shop_data->point
        ));
    }

    /**
     * مدل داده‌ای را ذخیره می‌کند
     *
     * مدل داده‌ای را بر اساس تغییرات تعیین شده توسط کاربر به روز می‌کند. در
     * صورتی
     * که پارامتر ورودی با نا درستی مقدار دهی شود تغییراد ذخیره نمی شود در غیر
     * این
     * صورت داده‌ها در پایگاه داده ذخیره می‌شود.
     *
     * @param $commit داده‌ها
     *            ذخیره شود یا نه
     * @return مدل داده‌ای ایجاد شده
     */
    function save($commit = true)
    {
        if (! $this->isValid()) {
            throw new Pluf_Exception(__('Cannot save the model from an invalid form.'));
        }
        $this->shop_data->setFromFormData($this->cleaned_data);
        if ($commit) {
            if (! $this->shop_data->create()) {
                throw new Pluf_Exception(__('Fail to create shop profile!'));
            }
        }
        return $this->shop_data;
    }

    /**
     * داده‌ها را به روز می‌کند.
     *
     * @throws Pluf_Exception
     */
    function update($commit = true)
    {
        if (! $this->isValid()) {
            throw new Pluf_Exception(__('Cannot save the model from an invalid form.'));
        }
        $this->shop_data->setFromFormData($this->cleaned_data);
        if ($commit) {
            $this->shop_data->update();
        }
        return $this->shop_data;
    }

    /**
     * بررسی صحت نام خانوادگی
     *
     * @return string|unknown
     */
    function clean_name()
    {
        $name = trim($this->cleaned_data['name']);
        if ($name == mb_strtoupper($name)) {
            return mb_convert_case(mb_strtolower($name), MB_CASE_TITLE, 'UTF-8');
        }
        return $name;
    }

}
