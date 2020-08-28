<?php

/**
 * ساختار داده‌ای مناطق و محدوده‌های جغرافیایی را تعیین می‌کند.
 * 
 * @author hadi <mohammad.hadi.mansouri@dpq.co.ir>
 *
 */
class Shop_Zone extends Shop_DetailedObject
{

    /**
     * مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        parent::init();
        $this->_model = 'Shop_Zone';
        $this->_a['table'] = 'shop_zone';
        $this->_a['verbose'] = 'Shop zone';
        $this->_a['cols'] = array_merge($this->_a['cols'], array(
            'province' => array(
                'type' => 'Varchar',
                'size' => 100,
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'city' => array(
                'type' => 'Varchar',
                'size' => 100,
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'address' => array(
                'type' => 'Varchar',
                'size' => 500,
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'polygon' => array(
                'type' => 'Geometry',
                'is_null' => true,
                'editable' => true,
                'readable' => true
            ),
            'deleted' => array(
                'type' => 'Boolean',
                'blank' => false,
                'default' => false,
                'editable' => false
            ),
            'creation_dtime' => array(
                'type' => 'Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            'modif_dtime' => array(
                'type' => 'Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            /*
             * Relations
             */
            'owner_id' => array(
                'type' => 'Foreignkey',
                'model' => 'User_Account',
                'name' => 'owner',
                'graphql_name' => 'owner',
                'relate_name' => 'owned_zones',
                'blank' => true,
                'editable' => true,
                'readable' => true
            ),
            'member' => array(
                'type' => 'Manytomany',
                'model' => 'User_Account',
                'name' => 'members',
                'graphql_name' => 'members',
                'relate_name' => 'zones',
                'blank' => false,
                'editable' => false
            )
        ));
    }

    /**
     * Checks if given user is a memeber of zone
     *
     * @param User_Account $user            
     * @return boolean
     */
    function isMember($user)
    {
        $usres = $this->get_member_list();
        foreach ($usres as $u)
            if ($u->getId() == $user->getId())
                return true;
        return false;
    }

    /**
     * Checks if given user is owner of zone
     *
     * @param User_Account $user            
     * @return boolean
     */
    function isOwner($user)
    {
        return $this->get_owner()->getId() == $user->getId();
    }

    public function loadViews(): array
    {
        $engine = $this->getEngine();
        $schema = $engine->getSchema();
        
        /*
         * Views
         */
        $u_asso = $schema->getRelationTable($this, new User_Account());
        $t_zone = $schema->getTableName($this);
        
        $zone_fk = $schema->getAssocField($this);
        return array(
            'join_user' => array(
                'join' => 'LEFT JOIN ' . $u_asso . ' ON ' . $t_zone . '.id=' . $zone_fk
            )
        );
    }
    
    /**
     * پیش ذخیره را انجام می‌دهد
     *
     * @param $create boolean
     *            ساخت یا به روز رسانی را تعیین می‌کند
     */
    function preSave($create = false)
    {
        if ($this->id == '') {
            $this->creation_dtime = gmdate('Y-m-d H:i:s');
        }
        $this->modif_dtime = gmdate('Y-m-d H:i:s');
    }
}