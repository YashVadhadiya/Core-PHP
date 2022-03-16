<?php
Ccc::loadClass('Model_Core_Row');
class Model_Customer extends Model_Core_Row
{

    protected $billingAddress;
    
    public function getBillingAddress($reload = false)
    {
        $billingAddressModel = Ccc::getModel('Customer_Address');
        
        if(!$this->id)
        {
            return $billingAddressModel;
        }

        if($this->billingAddress && !$reload)
        { 
            return $this->billingAddress;
        }

        $billingAddress = $billingAddressModel->fetchRow("SELECT * from address WHERE customerId = {$this->id} AND billing = 1");
        if(!$billingAddress)
        {
            return $billingAddressModel;
        }
        $this->setBillingAddress($billingAddress);
        return $billingAddress;
    }

    public function setBillingAddress(Model_customer_Address $address)
    {
        $this->billingAddress = $address;
        return $this;
    }

    protected $shippingAddress;
    
    public function getShippingAddress($reload = false)
    {
        $shippingAddressModel = Ccc::getModel('Customer_Address');
        
        if(!$this->id)
        {
            return $shippingAddressModel;
        }

        if($this->shippingAddress && !$reload)
        { 
            return $this->shippingAddress;
        }
        $shippingAddress = $shippingAddressModel->fetchRow("SELECT * from address WHERE customerId = {$this->id} AND shipping = 1");
        if(!$shippingAddress)
        {
            return $shippingAddressModel;
        }
        $this->setShippingAddress($shippingAddress);
        return $shippingAddress;
    }

    public function setShippingAddress(Model_customer_Address $address)
    {
        $this->shippingAddress = $address;
        return $this;
    }

    protected $salesman;

    public function getSalesman($reload = false)
    {
        $salesmanModel = Ccc::getModel('salesman_Address');
        
        if(!$this->salesmanId)
        {
            return $salesmanModel;
        }

        if($this->salesman && !$reload)
        { 
            return $this->salesman;
        }
        $salesman = $salesmanModel->fetchAll("SELECT * from salesman WHERE salesmanId = {$this->salesmanId}");
        if(!$salesman)
        {
            return $salesmanModel;
        }
        $this->setsalesman($salesman);
        return $salesman;
    }

    public function setsalesman(Model_salesman $salesman)
    {
        $this->salesman = $salesman;
        return $this;
    }

    protected $price;

    public function getPrice($reload = false)
    {
        $priceModel = Ccc::getModel('Customer_Price');
        
        if(!$this->entityId)
        {
            return $priceModel;
        }

        if($this->price && !$reload)
        { 
            return $this->price;
        }
        $price = $priceModel->fetchAll("SELECT * from customer_price WHERE entityId = {$this->priceId}");
        if(!$price)
        {
            return $priceModel;
        }
        $this->setprice($price);
        return $price;
    }

    public function setprice(Model_price $price)
    {
        $this->price = $price;
        return $this;
    }

	const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DEFAULT = 1;
    const STATUS_ENABLED_LBL = 'Active';
    const STATUS_DISABLED_LBL = 'InActive';  

	public function __construct()
	{
		$this->setResourceClassName('Customer_Resource');
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

    public function selectedCustomerData($customerIds)
    {
        $request = Ccc::getFront();
        $id = $request->getRequest()->getRequest('id');
        foreach($customerIds as $customerId) 
        {   
            $salesmanCustomer = Ccc::getModel('Customer');
            $salesmanCustomer->id = $customerId;
            $salesmanCustomer->salesmanId = $id;
            $result = $salesmanCustomer->save();
        }
        return $result;
    }
}

