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
		$shippingMethods = $shippingMethod->fetchAll("SELECT * from `shipping_method`;");
		return $shippingMethods;
	}

	public function getCart()
	{
		$customerId = Ccc::getFront()->getRequest()->getRequest('id');
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->fetchRow("SELECT * from `cart` WHERE customerId = {$customerId} ;");
		return $cart;
	}	
}