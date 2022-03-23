<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_Address extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/address.php');
	}

	public function getBillingAddress()
	{
		$customerId = Ccc::getFront()->getRequest()->getRequest('id');
		$customer = Ccc::getModel('Customer');
		$customer = $customer->fetchRow("SELECT * from `address` WHERE `customerId` = {$customerId} AND billing = 1;");
		return $customer;
	}
	
	public function getShippingAddress()
	{
		$customerId = Ccc::getFront()->getRequest()->getRequest('id');
		$customer = Ccc::getModel('Customer');
		$shippingAddress = $customer->fetchRow("SELECT * from `address` WHERE `customerId` = {$customerId} AND shipping = 1;");
		return $shippingAddress;
	}

	public function getCustomer()
	{
		$customerId = Ccc::getFront()->getRequest()->getRequest('id');
		$customer = Ccc::getModel('Customer');
		$customer = $customer->fetchRow("SELECT * from `customer` WHERE `id` = {$customerId} ");
		return $customer;
	}

	public function getCartBillingAddress()
	{
		$customerId = Ccc::getFront()->getRequest()->getRequest('id');
		$customer = Ccc::getModel('Customer')->load($customerId);
		$cartId = $customer->getCart()->cartId;
		//print_r($cartId); die;
		$customer = $customer->fetchRow("SELECT * from `cart_address` WHERE `cartId` = {$cartId} AND billing = 1;");
		return $customer;
	}

	public function getCartShippingAddress()
	{
		$customerId = Ccc::getFront()->getRequest()->getRequest('id');
		$customer = Ccc::getModel('Customer')->load($customerId);
		$cartId = $customer->getCart()->cartId;
		//print_r($cartId); die;
		$customer = $customer->fetchRow("SELECT * from `cart_address` WHERE `cartId` = {$cartId} AND shipping = 1;");
		return $customer;
	}
}