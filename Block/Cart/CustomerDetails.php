<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_CustomerDetails extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/customerDetails.php');
	}

	public function getCustomer()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer');
		return $customer->fetchRow("SELECT * from `customer` WHERE `id` = {$customerId};");
	}
}