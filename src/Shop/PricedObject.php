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
                'editable' => true,
                'readable' => true
            ),
            'off' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'editable' => true,
                'readable' => true
            ),
            'deleted' => array(
                'type' => 'Pluf_DB_Field_Boolean',
                'blank' => false,
                'default' => false,
                'editable' => false,
                'readable' => false
            )
        ));
    }
}
