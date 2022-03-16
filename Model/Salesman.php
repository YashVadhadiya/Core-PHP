<?php

Ccc::loadClass('Model_Core_Row');
class Model_Salesman extends Model_Core_Row
{   
    protected $customerModel;

    public function getCustomers($reload = false)
    {
        $customerModel = Ccc::getModel('Customer_Address');
        
        if(!$this->customerId)
        {
            return $customerModel;
        }

        if($this->customers && !$reload)
        { 
            return $this->customers;
        }
        $customers = $customerModel->fetchAll("SELECT * from customer");
        if(!$customers)
        {
            return $customerModel;
        }
        //$this->setCustomers($customers);
        return $customers;
    }

    public function setCustomers(Model_Customer $customer)
    {
        $this->customers = $customer;
        return $this;
    }

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DEFAULT = 1;
    const STATUS_ENABLED_LBL = 'Enabled';
    const STATUS_DISABLED_LBL = 'Disabled';   

    public function __construct()
    {
        $this->setResourceClassName('Salesman_Resource');
    }

    public function getStatus($key = null)
    {       
        
        $statues = [self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
                    self::STATUS_DISABLED => self::STATUS_DISABLED_LBL];

        if(!$key)
        {
            return $statues;
        }

        if(array_key_exists($key , $statues))
        {
            return $statues[$key];
        }

        return self::STATUS_DEFAULT;
    }
}

