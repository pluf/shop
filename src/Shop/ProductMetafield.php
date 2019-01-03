<?php

class Shop_ProductMetafield extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'shop_product_metafield';
        $this->_a['verbose'] = 'Shop_ProductMetafield';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'key' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => false,
                'blank' => false,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'value' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => false,
                'blank' => false,
                'size' => 256,
                'editable' => true,
                'readable' => true
            ),
            'unit' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'is_null' => true,
                'size' => 64,
                'editable' => true,
                'readable' => true
            ),
            'namespace' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => true,
                'blank' => true,
                'size' => 128,
                'editable' => true,
                'readable' => true
            ),
            /*
             * Relations
             */
            'product_id' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Shop_Product',
                'name' => 'product',
                'graphql_name' => 'product',
                'relate_name' => 'metafields',
                'is_null' => false,
                'blank' => false,
                'editable' => false,
                'readable' => true
            )
        );
        
        $this->_a['idx'] = array(
            'metafield_idx' => array(
                'col' => 'key, product_id',
                'type' => 'unique', // normal, unique, fulltext, spatial
                'index_type' => '', // hash, btree
                'index_option' => '',
                'algorithm_option' => '',
                'lock_option' => ''
            )
        );
    }
    
}
