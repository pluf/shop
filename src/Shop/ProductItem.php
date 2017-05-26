<?php

class Shop_ProductItem extends Shop_OrderItem
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        parent::init();
        $this->_a['table'] = 'shop_product_item';
        $this->_a['verbose'] = 'Shop_ProductItem';
        // Merge parent columns with new columns
        $this->_a['cols'] = array_merge($this->_a['cols'], array(
            'count' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'editable' => true,
                'readable' => true
            ),
            // relations
            'product' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Shop_Product',
                'relate_name' => 'product',
                'blank' => false,
                'editable' => false,
                'readable' => true
            )
        ));
    }
}
