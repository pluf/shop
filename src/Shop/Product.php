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
                'blank' => true,
                'is_null' => true,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'brand' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'is_null' => true,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'model' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'is_null' => true,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'properties' => array(
                'type' => 'Pluf_DB_Field_Text',
                'blank' => true,
                'is_null' => true,
                'size' => 3000,
                'editable' => true,
                'readable' => true
            ),
            // relations
            'taxes' => array(
                'type' => 'Pluf_DB_Field_Manytomany',
                'model' => 'Shop_TaxClass',
                'name' => 'taxes',
                'graphql_name' => 'taxes',
                'relate_name' => 'products',
                'editable' => false,
                'readable' => true
            )
        ));
        // Set the field name in the another entity in the relationship
        $this->_a['cols']['categories']['relate_name'] = 'products';
        $this->_a['cols']['tags']['relate_name'] = 'products';
    }

    function toString(){
        $str = $this->title . ' (' . $this->brand;
        if(isset($this->model)){
            $str = $str . ' - ' . $this->model;
        }
        $str = $str . ')';
        return $str;
    }
    
    function clean_off(){
        if($this->off !== null){
            return $this->off;
        }
        return 0;
    }
    
}
