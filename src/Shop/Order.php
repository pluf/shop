<?php

class Shop_Order extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'shop_order';
        $this->_a['verbose'] = 'Shop_Order';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'is_null' => false,
                'editable' => false,
                'readable' => true
            ),
            'secureId' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'is_null' => false,
                'size' => 50,
                'readable' => false,
                'editable' => false
            ),
            'title' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'is_null' => false,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'full_name' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 50,
                'readable' => true,
                'editable' => true
            ),
            'phone' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 30,
                'readable' => true,
                'editable' => true
            ),
            'email' => array(
                'type' => 'Pluf_DB_Field_Email',
                'blank' => true,
                'readable' => true,
                'editable' => true
            ),
            'province' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'size' => 100,
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'city' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'size' => 100,
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'address' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'size' => 500,
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'point' => array(
                'type' => 'Pluf_DB_Field_Geometry',
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'description' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'manager' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 100,
                'editable' => false,
                'readable' => false
            ),
            'state' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 50,
                'editable' => true,
                'readable' => true
            ),
            'deleted' => array(
                'type' => 'Pluf_DB_Field_Boolean',
                'blank' => false,
                'default' => false,
                'readable' => true,
                'editable' => false
            ),
            'creation_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            'modif_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            // relations
            // 'items' => array(
            // 'type' => 'Pluf_DB_Field_Manytomany',
            // 'model' => 'Shop_OrderItem',
            // 'relate_name' => 'items',
            // 'editable' => false,
            // 'readable' => false
            // ),
            'customer' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'User',
                'relate_name' => 'customer',
                'is_null' => true,
                'editable' => false,
                'readable' => true
            ),
            'assignee' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'User',
                'relate_name' => 'assignee',
                'is_null' => true,
                'editable' => false,
                'readable' => true
            ),
            'deliver_type' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Shop_DeliverType',
                'relate_name' => 'deliver_type',
                'is_null' => true,
                'editable' => false,
                'readable' => true
            ),
            'payment' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Bank_Receipt',
                'relate_name' => 'payment',
                'is_null' => true,
                'editable' => false,
                'readable' => true
            ),
            'zone' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Shop_Zone',
                'relate_name' => 'zone',
                'is_null' => true,
                'editable' => false,
                'readable' => true
            ),
            'agency' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Shop_Agency',
                'relate_name' => 'agency',
                'is_null' => true,
                'editable' => false,
                'readable' => true
            )
        );
        
        // $this->_a['idx'] = array(
        // 'page_class_idx' => array(
        // 'col' => 'title',
        // 'type' => 'unique', // normal, unique, fulltext, spatial
        // 'index_type' => '', // hash, btree
        // 'index_option' => '',
        // 'algorithm_option' => '',
        // 'lock_option' => ''
        // )
        // );
    }

    /**
     * \brief پیش ذخیره را انجام می‌دهد
     *
     * @param $create bool status of creation
     */
    function preSave($create = false)
    {
        if ($this->id == '') {
            $this->creation_dtime = gmdate('Y-m-d H:i:s');
            $this->secureId = $this->getSecureId();
        }
        $this->modif_dtime = gmdate('Y-m-d H:i:s');
    }

    /**
     * حالت کار ایجاد شده را به روز می‌کند
     *
     * @see Pluf_Model::postSave()
     */
    function postSave($create = false)
    {
        //
    }

    /**
     * یک کلید جدید را ایجاد می‌کند.
     *
     * از این کلید برای دستیابی به داده‌ها استفاده می‌شود.
     */
    function getSecureId()
    {
        while (1) {
            $key = md5(microtime() . rand(0, 123456789) . rand(0, 123456789) . Pluf::f('secret_key'));
            $sess = $this->getList(array(
                'filter' => 'secureId=\'' . $key . '\''
            ));
            if (count($sess) == 0) {
                break;
            }
        }
        return $key;
    }

    /**
     * Returns an object which manages order
     * 
     * @return Shop_Order_Manager
     */
    function getManager()
    {
        $managerClassName = $this->manager;
        if (! isset($managerClassName) || empty($managerClassName))
            $managerClassName = Tenant_Service::setting('Shop.Order.Manager', 'Shop_Order_Manager_Default');
        return new $managerClassName();
    }

    /**
     * Computes and returns total price of order
     * 
     * @return number
     */
    function computeTotalPrice()
    {
        $orderItem = new Shop_OrderItem();
        $q = new Pluf_SQL('`order`=%s', array(
            $this->getId()
        ));
        $items = $orderItem->getList(array(
            'filter' => $q->gen()
        ));
        $totalPrice = 0;
        foreach ($items as $item) {
            $totalPrice += ($item->price - $item->off) * $item->count;
        }
        // TODO: hadi: add tax and delivery cost
        return $totalPrice;
    }

    function hasPayment(){
        return $this->payment != null || $this->payment != 0;
    }
    
    function isPayed()
    {
        if (! $this->payment) {
            return false;
        }
        $receipt = $this->get_payment();
        Bank_Service::update($receipt);
        return $this->get_payment()->isPayed();
    }
    
    function invalidatePayment(){
        $this->payment = null;
    }
}
