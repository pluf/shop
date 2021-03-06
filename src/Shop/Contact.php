<?php

/**
 * مدل داده‌ای برای ذخیره انواع اطلاعات تماس مثل آدرس رایانامه، شماره تلفن، شماره همراه و ...
 * @author hadi
 *
 * @deprecated It will be replaced by some mapped class of User_Email and User_Phone in the near future.
 */
class Shop_Contact extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'shop_contact';
        $this->_a['verbose'] = 'Shop_Contact';
        $this->_a['multitenant'] = false;
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Sequence',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'contact' => array(
                'type' => 'Varchar',
                'blank' => false,
                'is_null' => false,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'type' => array(
                'type' => 'Varchar',
                'blank' => true,
                'size' => 50,
                'editable' => true,
                'readable' => true
            ),
            'creation_dtime' => array(
                'type' => 'Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            /*
             * Relations
             */
            'user_id' => array(
                'type' => 'Foreignkey',
                'model' => 'User_Account',
                'name' => 'user',
                'graphql_name' => 'user',
                'relate_name' => 'contacts',
                'is_null' => true,
                'editable' => false,
                'readable' => true
            )
        );
        
        // $this->_a['idx'] = array(
        // 'page_class_idx' => array(
        // 'col' => 'title',
        // 'type' => 'unique', // normal, unique, fulltext, spatial
        // 'index_type' => '', // hash, btree
        // 'index_option' => '',
        // 'algorithm_option' => '',
        // 'lock_option' => ''
        // )
        // );
    }

    /**
     * \brief پیش ذخیره را انجام می‌دهد
     *
     * @param $create boolean
     *            ساخت یا به روز رسانی را تعیین می‌کند
     */
    function preSave($create = false)
    {
        if ($this->id == '') {
            $this->creation_dtime = gmdate('Y-m-d H:i:s');
        }
    }
}
