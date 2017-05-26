<?php

class Shop_Service extends Shop_PricedObject
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        parent::init();
        $this->_a['table'] = 'shop_service';
        $this->_a['verbose'] = 'Shop_Service';
        // Merge parent columns with new columns
        $this->_a['cols'] = array_merge($this->_a['cols'], array(
            'properties' => array(
                'type' => 'Pluf_DB_Field_Text',
                'blank' => true,
                'size' => 3000,
                'editable' => true,
                'readable' => true
            ),
            // relations
            'taxes' => array(
                'type' => 'Pluf_DB_Field_Manytomany',
                'model' => 'Shop_TaxClass',
                'relate_name' => 'taxes',
                'editable' => false,
                'readable' => false
            )
        ));
    }
}
