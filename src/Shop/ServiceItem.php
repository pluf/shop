<?php

class Shop_ServiceItem extends Shop_OrderItem
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        parent::init();
        $this->_a['table'] = 'shop_service_item';
        $this->_a['verbose'] = 'Shop_ServiceItem';
        // Merge parent columns with new columns
        $this->_a['cols'] = array_merge($this->_a['cols'], array(
            // relations
            'service' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Shop_Service',
                'relate_name' => 'service',
                'blank' => false,
                'editable' => false,
                'readable' => true
            )
        ));
    }
}
