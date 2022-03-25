<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_ShippingMethod extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/shippingMethod.php');
	}

	public function getShippingMethods()
	{
		$shippingMethod = Ccc::getModel('ShippingMethod');
		return $shippingMethod->fetchAll("SELECT * from `shipping_method`;");
	}

	public function getCart()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$cartModel = Ccc::getModel('Cart');
		return $cartModel->fetchRow("SELECT * from `cart` WHERE customerId = {$customerId} ;");
	}	
}