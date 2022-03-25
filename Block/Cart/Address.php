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
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer');
		return $customer->fetchRow("SELECT * from `address` WHERE `customerId` = {$customerId} AND billing = 1;");
	}
	
	public function getShippingAddress()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer');
		return $customer->fetchRow("SELECT * from `address` WHERE `customerId` = {$customerId} AND shipping = 1;");
	}

	public function getCustomer()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer');
		return $customer->fetchRow("SELECT * from `customer` WHERE `id` = {$customerId} ");
	}

	public function getCartBillingAddress()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer')->load($customerId);
		$cartId = $customer->getCart()->cartId;
		return $customer->fetchRow("SELECT * from `cart_address` WHERE `cartId` = {$cartId} AND billing = 1;");
	}

	public function getCartShippingAddress()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer')->load($customerId);
		$cartId = $customer->getCart()->cartId;
		return $customer->fetchRow("SELECT * from `cart_address` WHERE `cartId` = {$cartId} AND shipping = 1;");
	}
}