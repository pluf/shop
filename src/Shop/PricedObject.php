<?php

class Shop_PricedObject extends Shop_DetailedObject
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        // $this->_a['table'] = 'shop_pricedobject';
        // $this->_a['verbose'] = 'Shop_PricedObject';
        parent::init();
        // Merge parent columns with new columns
        $this->_a['cols'] = array_merge($this->_a['cols'], array(
            'price' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'is_null' => false,
                'editable' => true,
                'readable' => true
            ),
            'off' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => true,
                'is_null' => true,
                'default' => 0,
                'editable' => true,
                'readable' => true
            ),
            'deleted' => array(
                'type' => 'Pluf_DB_Field_Boolean',
                'blank' => false,
                'default' => false,
                'editable' => false
            ),
            /*
             * Relations
             */
            'categories' => array(
                'type' => 'Pluf_DB_Field_Manytomany',
                'model' => 'Shop_Category',
                'name' => 'categories',
                'graphql_name' => 'categories',
                'editable' => false
            ),
            'tags' => array(
                'type' => 'Pluf_DB_Field_Manytomany',
                'model' => 'Shop_Tag',
                'name' => 'tags',
                'graphql_name' => 'tags',
                'editable' => false
            )
        ));
    }
}
