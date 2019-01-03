<?php

class Shop_Category extends Pluf_Model
{

    /**
     *
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'shop_category';
        $this->_a['verbose'] = 'Shop Category';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'name' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 250,
                'editable' => true,
                'readable' => true
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
            'description' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            /*
             * Relations
             */
            'parent_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Shop_Category',
                'blank' => true,
                'name' => 'parent',
                'graphql_name' => 'parent',
                'relate_name' => 'children',
                'editable' => true,
                'readable' => true
            ),
            'content_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'CMS_Content',
                'blank' => true,
                'name' => 'content',
                'graphql_name' => 'content',
                'relate_name' => 'categories',
                'editable' => true,
                'readable' => true
            ),
            'thumbnail_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'CMS_Content',
                'blank' => true,
                'name' => 'thumbnail',
                'graphql_name' => 'thumbnail',
                'relate_name' => 'categories',
                'editable' => true,
                'readable' => true
            )
        );

        $this->_a['idx'] = array(
            'category_idx' => array(
                'col' => 'parent_id, name',
                'type' => 'unique', // normal, unique, fulltext, spatial
                'index_type' => '', // hash, btree
                'index_option' => '',
                'algorithm_option' => '',
                'lock_option' => ''
            )
        );
    }

    /**
     * \brief پیش ذخیره را انجام می‌دهد
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

    /**
     * \brief عملیاتی که قبل از پاک شدن است انجام می‌شود
     *
     * عملیاتی که قبل از پاک شدن است انجام می‌شود
     * در این متد فایل مربوط به است حذف می شود. این عملیات قابل بازگشت نیست
     */
    function preDelete()
    {}
}