<?php

/**
 * ساختار داده‌ای شعب یک فروشگاه را تعیین می‌کند.
 * 
 * @author hadi <mohammad.hadi.mansouri@dpq.co.ir>
 *
 */
class Shop_Agency extends Pluf_Model
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
        $this->_a['table'] = 'shop_agency';
        $this->_a['model'] = 'Shop_Agency';
        $this->_model = 'Shop_Agency';
        
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => true,
                'editable' => false
            ),
//             'tenant' => array(
//                 'type' => 'Pluf_DB_Field_Foreignkey',
//                 'model' => 'Pluf_Tenant',
//                 'blank' => false,
//                 'unique' => true,
//                 'editable' => false
//             ),
            'title' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'size' => 250,
                'is_null' => false,
                'editable' => true,
                'readable' => true
            ),
            'description' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => true,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'province' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'size' => 100,
                'is_null' => false,
                'editable' => true,
                'readable' => true
            ),
            'city' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'size' => 100,
                'is_null' => false,
                'editable' => true,
                'readable' => true
            ),
            'address' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'size' => 500,
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'phone' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'size' => 50,
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'image' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'size' => 300,
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'point' => array(
                'type' => 'Geo_DB_Field_Point',
                'is_null' => false
            ),
            'deleted' => array(
                'type' => 'Pluf_DB_Field_Boolean',
                'is_null' => false,
                'default' => false,
                'editable' => false,
                'readable' => false
            ),
            'creation_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'verbose' => __('creation date'),
                'editable' => false
            ),
            'modif_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'verbose' => __('modification date'),
                'editable' => false
            ),
            // رابطه‌ها
            'owner' => array(
                'type' => 'Pluf_DB_Field_Manytomany',
                'model' => 'Pluf_User',
                'relate_name' => 'owner',
                'editable' => true,
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
     * @param $create حالت
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