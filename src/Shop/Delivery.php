<?php

class Shop_Delivery extends Shop_PricedObject
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        parent::init();
        $this->_a['table'] = 'shop_delivery';
        $this->_a['verbose'] = 'Shop_Delivery';
        // Merge parent columns with new columns
        $this->_a['cols'] = array_merge($this->_a['cols'], array());
        // Set the field name in the another entity in the relationship
        $this->_a['cols']['categories']['relate_name'] = 'deliveries';
        $this->_a['cols']['tags']['relate_name'] = 'deliveries';
    }
}
