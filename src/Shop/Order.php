<?php

class Shop_Order extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'shop_order';
        $this->_a['verbose'] = 'Shop_Order';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'is_null' => false,
                'editable' => false,
                'readable' => true
            ),
            'secureId' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => false,
                'size' => 50,
                'readable' => false,
                'editable' => false
            ),
            'title' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'full_name' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 50,
                'readable' => true,
                'editable' => true
            ),
            'phone' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 30,
                'readable' => true,
                'editable' => true
            ),
            'email' => array(
                'type' => 'Pluf_DB_Field_Email',
                'blank' => true,
                'readable' => true,
                'editable' => true
            ),
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
            'point' => array(
                'type' => 'Geo_DB_Field_Point',
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'description' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'workflow' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 100,
                'editable' => true,
                'readable' => true
            ),
            'state' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 50,
                'editable' => true,
                'readable' => true
            ),
            'deleted' => array(
                'type' => 'Pluf_DB_Field_Boolean',
                'blank' => false,
                'default' => false,
                'readable' => true,
                'editable' => false
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
            // relations
//             'items' => array(
//                 'type' => 'Pluf_DB_Field_Manytomany',
//                 'model' => 'Shop_OrderItem',
//                 'relate_name' => 'items',
//                 'editable' => false,
//                 'readable' => false
//             ),
            'customer' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Pluf_User',
                'relate_name' => 'customer',
                'is_null' => true,
                'editable' => false,
                'readable' => true
            ),
            'deliver_type' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Shop_DeliverType',
                'relate_name' => 'deliver_type',
                'is_null' => true,
                'editable' => false,
                'readable' => true
            ),
            'payment' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Bank_Receipt',
                'relate_name' => 'payment',
                'is_null' => true,
                'editable' => false,
                'readable' => true
            ),
            'zone' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Shop_Zone',
                'relate_name' => 'zone',
                'is_null' => true,
                'editable' => false,
                'readable' => true
            ),
            'agency' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Shop_DeliverType',
                'relate_name' => 'agency',
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
