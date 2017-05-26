<?php

class Shop_OrderItem extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
//         $this->_a['table'] = 'shop_order_item';
//         $this->_a['verbose'] = 'Shop_OrderItem';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'price' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'editable' => true,
                'readable' => true
            ),
            'off' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'editable' => true,
                'readable' => true
            ),
            'creation_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            // relations
            'order' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Shop_Order',
                'relate_name' => 'order',
                'blank' => false,
                'editable' => false,
                'readable' => true
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
    }
}
