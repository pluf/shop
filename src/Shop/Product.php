<?php

class Shop_Product extends Shop_PricedObject
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        parent::init();
        $this->_a['table'] = 'shop_product';
        $this->_a['verbose'] = 'Shop_Product';
        // Merge parent columns with new columns
        $this->_a['cols'] = array_merge($this->_a['cols'], array(
            'manufacturer' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'brand' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'model' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
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

    function toString(){
        $str = $this->title . ' (' . $this->brand;
        if(isset($this->model)){
            $str = $str . ' - ' . $this->model;
        }
        $str = $str . ')';
        return $str;
    }
    
}
