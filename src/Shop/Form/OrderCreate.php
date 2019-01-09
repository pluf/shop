<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');

/**
 * ایجاد یک درخواست جدید
 *
 * با استفاده از این فرم می‌توان یک درخواست جدید را ایجاد کرد.
 *
 * @author hadi <mohammad.hadi.mansouri@dpq.co.ir>
 *        
 */
class Shop_Form_OrderCreate extends Pluf_Form
{

    public $user = null;

    public function initFields($extra = array())
    {
        $this->user = $extra['user'];
        
        $this->fields['title'] = new Pluf_Form_Field_Varchar(array(
            'required' => false,
            'label' => 'Order Title',
            'help_text' => 'Title for order'
        ));
        
        $this->fields['full_name'] = new Pluf_Form_Field_Varchar(array(
            'required' => true,
            'label' => 'Full Name',
            'help_text' => 'Full name of user who submits order'
        ));
        
        $this->fields['phone'] = new Pluf_Form_Field_Varchar(array(
            'required' => true,
            'label' => 'Phone Number',
            'help_text' => 'Phone number of user who submits order'
        ));
        
        $this->fields['email'] = new Pluf_Form_Field_Email(array(
            'required' => false,
            'label' => 'Email',
            'help_text' => 'Email address of user who submits order'
        ));
        
        $this->fields['province'] = new Pluf_Form_Field_Varchar(array(
            'required' => false,
            'label' => 'Province',
            'help_text' => 'Province to do order'
        ));
        
        $this->fields['city'] = new Pluf_Form_Field_Varchar(array(
            'required' => false,
            'label' => 'City',
            'help_text' => 'City to do order'
        ));
        
        $this->fields['address'] = new Pluf_Form_Field_Varchar(array(
            'required' => false,
            'label' => 'Address',
            'help_text' => 'Address to do order'
        ));
        
        $this->fields['point'] = new Pluf_Form_Field_Geometry(array(
            'required' => false,
            'label' => 'Point',
            'help_text' => 'GeoPoint location to do order'
        ));
        
        $this->fields['description'] = new Pluf_Form_Field_Varchar(array(
            'required' => false,
            'label' => 'Description',
            'help_text' => 'Description or Extra information about order'
        ));
        
    }

    function save($commit = true)
    {
        if (! $this->isValid()) {
            throw new Pluf_Exception_Form('cannot save the order from an invalid form', $this);
        }
        // Create the order
        $order = new Shop_Order();
        $order->setFromFormData($this->cleaned_data);
        if ($this->user != null) {
            $order->customer_id = $this->user;
        }
        if ($commit) {
            $order->create();
        }
        return $order;
    }

    public function clean_full_name()
    {
        $fullname = trim($this->cleaned_data['full_name']);
        return $fullname;
    }

    public function clean_phone()
    {
        $phone = trim($this->cleaned_data['phone']);
        return $phone;
    }

    public function clean_email()
    {
        $email = mb_strtolower(trim($this->cleaned_data['email']));
        // TODO: hadi 1395-01-26: بررسی صحت ایمیل
        return $email;
    }

    public function clean_province()
    {
        $province = trim($this->cleaned_data['province']);
        return $province;
    }
    public function clean_city()
    {
        $val = trim($this->cleaned_data['city']);
        return $val;
    }
    public function clean_address()
    {
        $val= trim($this->cleaned_data['address']);
        return $val;
    }
    public function clean_point()
    {
        $val= trim($this->cleaned_data['point']);
        return $val;
    }

    public function clean_description()
    {
        $extraInfo = trim($this->cleaned_data['description']);
        return $extraInfo;
    }
    
    /*
     *
     */
    public function clean()
    {
        return parent::clean();
    }
}
