<?php
Pluf::loadFunction('Shop_Shortcuts_GetItemClass');

class Shop_OrderItem extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'shop_order_item';
        $this->_a['verbose'] = 'Shop_OrderItem';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'title' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 250,
                'editable' => false,
                'readable' => true
            ),
            'item_id' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'is_null' => false,
                'editable' => true,
                'readable' => true
            ),
            'item_type' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'is_null' => false,
                'size' => 50,
                'editable' => true,
                'readable' => true
            ),
//             'properties' => array(
//                 'type' => 'Pluf_DB_Field_Text',
//                 'blank' => true,
//                 'size' => 3000,
//                 'editable' => true,
//                 'readable' => true
//             ),
            'count' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'is_null' => false,
                'default' => 1,
                'editable' => true,
                'readable' => true
            ),
            'price' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'is_null' => false,
                'editable' => false,
                'readable' => true
            ),
            'off' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'is_null' => false,
                'default' => 0,
                'editable' => false,
                'readable' => true
            ),
            'creation_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            /*
             * Relations
             */
            'order_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Shop_Order',
                'name' => 'order',
                'graphql_name' => 'order',
                'relate_name' => 'order_items',
                'blank' => false,
                'editable' => false,
                'readable' => true
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
        $itemClassName = Shop_Shortcuts_GetItemClass($this->item_type);
        $originItem = Pluf_Shortcuts_GetObjectOr404($itemClassName, $this->item_id);
        $this->title = $originItem->toString();
        $this->price = $originItem->price;
        $this->off = $originItem->off;
    }
    
    /**
     * Check if this item is blong to given Shop_Order
     * @param Shop_Order $order
     * @return boolean
     */
    function isBelongTo($order){
        return $this->order_id === $order->id;
    }
}
