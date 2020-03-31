<?php

/**
 * ساختار داده‌ای برای ذخیره آدرس‌ها و اطلاعات مکانی.
 * 
 * @author hadi <mohammad.hadi.mansouri@dpq.co.ir>
 *
 * @deprecated It will be replaced by a mapped class of the User_Address in the near future.
 */
class Shop_Address extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * تمام فیلدهای مورد نیاز برای این مدل داده‌ای در این متد تعیین شده و به
     * صورت کامل ساختار دهی می‌شود.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'shop_address';
        $this->_a['verbose'] = 'Shop_Address';
        $this->_model = 'Shop_Address';
        $this->_a['multitenant'] = false;
        
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Sequence',
                'blank' => true,
                'editable' => false
            ),
            'province' => array(
                'type' => 'Varchar',
                'size' => 100,
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'city' => array(
                'type' => 'Varchar',
                'size' => 100,
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'address' => array(
                'type' => 'Varchar',
                'size' => 500,
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'point' => array(
                'type' => 'Geometry',
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'creation_dtime' => array(
                'type' => 'Datetime',
                'blank' => true,
                'editable' => false
            ),
            'modif_dtime' => array(
                'type' => 'Datetime',
                'blank' => true,
                'editable' => false
            ),
            /*
             * Relations
             */
            'user_id' => array(
                'type' => 'Foreignkey',
                'model' => 'User_Account',
                'name' => 'user',
                'graphql_name' => 'user',
                'relate_name' => 'addresses',
                'is_null' => true,
                'editable' => false,
                'readable' => true
            ),
        );
    }

    /**
     * پیش ذخیره را انجام می‌دهد
     *
     * در این فرآیند نیازهای ابتدایی سیستم به آن اضافه می‌شود. این نیازها مقادیری هستند که
     * در زمان ایجاد باید تعیین شوند. از این جمله می‌توان به کاربر و تاریخ اشاره کرد.
     *
     * @param $create boolean
     *            ساخت یا به روز رسانی را تعیین می‌کند
     */
    function preSave($create = false)
    {
        if ($this->id == '') {
            $this->creation_dtime = gmdate('Y-m-d H:i:s');
        }
        $this->modif_dtime = gmdate('Y-m-d H:i:s');
    }
}