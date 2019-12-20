<?php

class Shop_OrderItemMetafield extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'shop_order_item_metafields';
        $this->_a['verbose'] = 'Shop_OrderItemMetafield';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'is_null' => false,
                'editable' => false
            ),
            'key' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => false,
                'size' => 250,
                'editable' => true
            ),
            'value' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => false,
                'size' => 256,
                'editable' => true
            ),
            /*
             * Relations
             */
            'order_item_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Shop_OrderItem',
                'name' => 'order_item',
                'graphql_name' => 'order_item',
                'relate_name' => 'metafields',
                'is_null' => false,
                'editable' => false
            )
        );
        
        $this->_a['idx'] = array(
            'metafield_idx' => array(
                'col' => 'key, order_item_id',
                'type' => 'unique', // normal, unique, fulltext, spatial
                'index_type' => '', // hash, btree
                'index_option' => '',
                'algorithm_option' => '',
                'lock_option' => ''
            )
        );
    }
    
}
