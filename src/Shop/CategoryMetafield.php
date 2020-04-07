<?php

class Shop_CategoryMetafield extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'shop_category_metafields';
        $this->_a['verbose'] = 'Shop_CategoryMetafield';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Sequence',
                'is_null' => false,
                'editable' => false
            ),
            'key' => array(
                'type' => 'Varchar',
                'is_null' => false,
                'size' => 250,
                'editable' => true
            ),
            'value' => array(
                'type' => 'Varchar',
                'is_null' => false,
                'size' => 256,
                'editable' => true
            ),
            /*
             * Relations
             */
            'category_id' => array(
                'type' => 'Foreignkey',
                'model' => 'Shop_Category',
                'name' => 'category',
                'graphql_name' => 'category',
                'relate_name' => 'metafields',
                'is_null' => false,
                'editable' => false
            )
        );
        
        $this->_a['idx'] = array(
            'metafield_idx' => array(
                'col' => 'key, category_id',
                'type' => 'unique', // normal, unique, fulltext, spatial
                'index_type' => '', // hash, btree
                'index_option' => '',
                'algorithm_option' => '',
                'lock_option' => ''
            )
        );
    }
    
}
