<?php

class Shop_DeliverType extends Shop_PricedObject
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        parent::init();
        $this->_a['table'] = 'shop_deliver_type';
        $this->_a['verbose'] = 'Shop_DeliverType';
        // Merge parent columns with new columns
        $this->_a['cols'] = array_merge($this->_a['cols'], array());
        // Set the field name in the another entity in the relationship
        $this->_a['cols']['categories']['relate_name'] = 'deliver_types';
        $this->_a['cols']['tags']['relate_name'] = 'deliver_types';
    }
}
