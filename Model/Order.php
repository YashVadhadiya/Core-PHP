<?php
Ccc::loadClass('Model_Core_Row');
class Model_Order extends Model_Core_Row
{	

	protected $billingAddress;
	protected $shippingAddress;
	protected $orderItem;
    const STATUS_PENDING = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_CANCELLED = 4;
    const STATUS_PACKAGING = 5;
    const STATUS_SHIPPED = 6;
    const STATUS_OUT_OF_DELIVERY = 7;
    const STATUS_DISPATCHED = 8;
    const STATUS_DEFAULT = 1;
    const STATUS_PENDING_LBL = 'PENDING';
    const STATUS_PROCESSING_LBL = 'PROCESSING'; 
    const STATUS_COMPLETED_LBL = 'COMPLETED'; 
    const STATUS_CANCELLED_LBL = 'CANCELLED'; 
    const STATUS_PACKAGING_LBL = 'PACKAGING'; 
    const STATUS_SHIPPED_LBL = 'SHIPPED'; 
    const STATUS_OUT_OF_DELIVERY_LBL = 'OUT OF DELIVERY'; 
    const STATUS_DISPATCHED_LBL = 'DISPATCHED';  

	public function __construct()
	{
		$this->setResourceClassName('Order_Resource');
		parent::__construct();
	}

	public function getBillingAddress($reload = false)
    {
        $billingAddressModel = Ccc::getModel('Order_Address');
        
        if(!$this->orderId)
        {
            return $billingAddressModel;
        }

        if($this->billingAddress && !$reload)
        { 
            return $this->billingAddressModel;
        }

        $billingAddress = $billingAddressModel->fetchRow("SELECT * from order_address WHERE orderId = {$this->orderId} AND type = 1");
        if(!$billingAddress)
        {
            return $billingAddressModel;
        }
        return $billingAddress;
    }

    public function setBillingAddress(Model_Order_Address $address)
    {
        $this->billingAddress = $address;
        return $this;
    }

    
    public function getShippingAddress($reload = false)
    {
        $shippingAddressModel = Ccc::getModel('Order_Address');
        
        if(!$this->orderId)
        {
            return $shippingAddressModel;
        }

        if($this->shippingAddress && !$reload)
        { 
            return $this->shippingAddress;
        }

        $shippingAddress = $shippingAddressModel->fetchRow("SELECT * from order_address WHERE orderId = {$this->orderId} AND type = 2");
        if(!$shippingAddress)
        {
            return $shippingAddressModel;
        }
        $this->setShippingAddress($shippingAddress);
        return $shippingAddress;
    }

    public function setShippingAddress(Model_Order_Address $address)
    {
        $this->shippingAddress = $address;
        return $this;
    }

    public function getOrderItem($reload = false)
    {
        $orderItemModel = Ccc::getModel('Order_Item');
        
        if(!$this->orderId)
        {
            return $orderItemModel;
        }

        if($this->order && !$reload)
        { 
            return $this->orderItemModel;
        }

        $orderItem = $orderItemModel->fetchAll("SELECT * from order_item WHERE orderId = {$this->orderId};");
        if(!$orderItem)
        {
            return $this->orderItemModel;
        }
        return $orderItem;
    }

    public function setOrderItem(Model_Order_Item $orderItem)
    {
        $this->orderItem = $orderItem;
        return $this;
    }


    public function getState($key = null)
    {       
        
        $states = [self::STATUS_PENDING => self::STATUS_PENDING_LBL,
                    self::STATUS_PROCESSING => self::STATUS_PROCESSING_LBL,
                    self::STATUS_COMPLETED => self::STATUS_COMPLETED_LBL,
                    self::STATUS_CANCELLED => self::STATUS_CANCELLED_LBL];

        if(!$key)
        {
            return $states;
        }

        if(array_key_exists($key , $states))
        {
            return $states[$key];
        }

        return self::STATUS_DEFAULT;
    }

    public function getStatus($key = null)
    {       
        
        $statues = [self::STATUS_PENDING => self::STATUS_PENDING_LBL,
                    self::STATUS_COMPLETED => self::STATUS_COMPLETED_LBL,
                    self::STATUS_PACKAGING => self::STATUS_PACKAGING_LBL,
                    self::STATUS_SHIPPED => self::STATUS_SHIPPED_LBL,
                    self::STATUS_OUT_OF_DELIVERY => self::STATUS_OUT_OF_DELIVERY_LBL,
                    self::STATUS_DISPATCHED => self::STATUS_DISPATCHED_LBL];

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