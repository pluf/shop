<?php

/**
 * ساختار تاریخچه عملیات انجام شده روی سفارشات را تعیین می‌کند.
 * 
 * @author hadi <mohammad.hadi.mansouri@dpq.co.ir>
 *
 */
class Shop_OrderHistory extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'shop_orderhistory';
        $this->_a['verbose'] = 'Shop Order History';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Sequence',
                'blank' => false,
                'is_null' => false,
                'editable' => false,
                'readable' => true
            ),
            'object_type' => array(
                'type' => 'Varchar',
                'blank' => false,
                'is_null' => false,
                'size' => 100,
                'editable' => false,
                'readable' => true
            ),
            'object_id' => array(
                'type' => 'Integer',
                'blank' => false,
                'is_null' => false,
                'editable' => false,
                'readable' => true
            ),
            'subject_type' => array(
                'type' => 'Varchar',
                'blank' => true,
                'is_null' => true,
                'size' => 100,
                'editable' => false,
                'readable' => true
            ),
            'subject_id' => array(
                'type' => 'Integer',
                'blank' => true,
                'is_null' => true,
                'editable' => false,
                'readable' => true
            ),
            'action' => array(
                'type' => 'Varchar',
                'blank' => false,
                'is_null' => false,
                'size' => 100,
                'editable' => false,
                'readable' => true
            ),
            'workflow' => array(
                'type' => 'Varchar',
                'blank' => true,
                'size' => 100,
                'editable' => true,
                'readable' => true
            ),
            'state' => array(
                'type' => 'Varchar',
                'blank' => true,
                'size' => 50,
                'editable' => true,
                'readable' => true
            ),
            'description' => array(
                'type' => 'Varchar',
                'blank' => true,
                'is_null' => true,
                'size' => 250,
                'editable' => false,
                'readable' => true
            ),
            'creation_dtime' => array(
                'type' => 'Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            // 'modif_dtime' => array(
            // 'type' => 'Datetime',
            // 'blank' => true,
            // 'editable' => false,
            // 'readable' => true
            // ),
            /*
             * Relations
             */
            'order_id' => array(
                'type' => 'Foreignkey',
                'model' => 'Shop_Order',
                'blank' => false,
                'is_null' => false,
                'name' => 'order',
                'graphql_name' => 'order',
                'relate_name' => 'histories',
                'editable' => false,
                'readable' => true
            )
        );
        
        $this->_a['idx'] = array(
            'order_history_idx' => array(
                'col' => 'order_id',
                'type' => 'normal', // normal, unique, fulltext, spatial
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