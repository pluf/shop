<?php

/**
 * ساختار داده‌ای مناطق و محدوده‌های جغرافیایی را تعیین می‌کند.
 * 
 * @author hadi <mohammad.hadi.mansouri@dpq.co.ir>
 *
 */
class Shop_Zone extends Shop_DetailedObject
{

    /**
     * مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        parent::init();
        $this->_model = 'Shop_Zone';
        $this->_a['table'] = 'shop_zone';
        $this->_a['verbose'] = 'Shop zone';
        $this->_a['cols'] = array_merge($this->_a['cols'], array(
            'province' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'size' => 100,
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'city' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'size' => 100,
                'is_null' => true,
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
            'polygon' => array(
                'type' => 'Geo_DB_Field_Polygon',
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'deleted' => array(
                'type' => 'Pluf_DB_Field_Boolean',
                'blank' => false,
                'default' => false,
                'editable' => false,
                'readable' => false
            ),
            'creation_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            'modif_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            // رابطه‌ها
            'owner' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Pluf_User',
                'relate_name' => 'owner',
                'blank' => true,
                'editable' => true,
                'readable' => true
            ),
            'member' => array(
                'type' => 'Pluf_DB_Field_Manytomany',
                'model' => 'Pluf_User',
                'relate_name' => 'member',
                'blank' => false,
                'editable' => false,
                'readable' => false
            )
        ));
    }

    /**
     * Checks if given user is a memeber of zone
     *
     * @param Pluf_User $user            
     * @return boolean
     */
    function isMember($user)
    {
        $usres = $this->get_member_list();
        foreach ($usres as $u)
            if ($u->getId() == $user->getId())
                return true;
        return false;
    }

    /**
     * Checks if given user is owner of zone
     *
     * @param Pluf_User $user            
     * @return boolean
     */
    function isOwner($user)
    {
        return $this->get_owner()->getId() == $user->getId();
    }

    /**
     * پیش ذخیره را انجام می‌دهد
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

    /**
     * حالت کار ایجاد شده را به روز می‌کند
     *
     * @see Pluf_Model::postSave()
     */
    function postSave($create = false)
    {
        //
    }
}