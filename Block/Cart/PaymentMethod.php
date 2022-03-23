<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_PaymentMethod extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/paymentMethod.php');
	}

	public function getPaymentMethods()
	{
		$paymentMethod = Ccc::getModel('PaymentMethod');
		$paymentMethods = $paymentMethod->fetchAll("SELECT * from `payment_method`;");
		return $paymentMethods;
	}
	public function getCart()
	{
		$customerId = Ccc::getFront()->getRequest()->getRequest('id');
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->fetchRow("SELECT * from `cart` WHERE customerId = {$customerId} ;");
		return $cart;
	}
}