<?php
Ccc::loadClass('Model_Core_Row');
class Model_Order_Item extends Model_Core_Row
{	
	public function __construct()
	{
		$this->setResourceClassName('Order_Item_Resource');
		parent::__construct();
	}

	public function getOrder($reload = false)
    {
        $orderModel = Ccc::getModel('Order');
        
        if(!$this->orderId)
        {
            return $orderModel;
        }

        if($this->order && !$reload)
        { 
            return $this->orderModel;
        }

        $order = $orderModel->fetchRow("SELECT * from order_item WHERE orderId = {$this->orderId};");
        if(!$order)
        {
            return $this->orderModel;
        }
        $this->setOrder($order);
        return $order;
    }

    public function setOrder(Model_Order $order)
    {
        $this->order = $order;
        return $this;
    }

}




