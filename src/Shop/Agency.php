<?php

/**
 * ساختار داده‌ای شعب یک فروشگاه را تعیین می‌کند.
 * 
 * @author hadi <mohammad.hadi.mansouri@dpq.co.ir>
 *
 */
class Shop_Agency extends Shop_DetailedObject
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
        parent::init();
        $this->_a['table'] = 'shop_agency';
        $this->_a['model'] = 'Shop_Agency';
        $this->_model = 'Shop_Agency';
        
        $this->_a['cols'] = array_merge($this->_a['cols'], array(
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
            'point' => array(
                'type' => 'Pluf_DB_Field_Geometry',
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'deleted' => array(
                'type' => 'Pluf_DB_Field_Boolean',
                'is_null' => false,
                'default' => false,
                'editable' => false
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
            /*
             * Relation
             */
            'owner_id' => array(
                'type' => 'Pluf_DB_Field_Manytomany',
                'model' => 'User_Account',
                'name' => 'owner',
                'graphql_name' => 'owner',
                'relate_name' => 'agencies',
                'editable' => true,
                'readable' => true
            ),
            'content_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'CMS_Content',
                'name' => 'content',
                'graphql_name' => 'content',
                'relate_name' => 'agencies',
                'is_null' => true,
                'editable' => true,
                'readable' => true
            )
        ));
    }

    /**
     * Checks if given user is a owner of zone
     *
     * @param User_Account $user            
     * @return boolean
     */
    function isOwner($user)
    {
        $usres = $this->get_owner_list();
        foreach ($usres as $u)
            if ($u->getId() == $user->getId())
                return true;
        return false;
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