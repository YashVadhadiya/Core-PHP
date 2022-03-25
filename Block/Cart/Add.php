<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_Add extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/Add.php');
	}

	public function getCustomers()
	{
		$customerModel = Ccc::getModel('Customer');
		return $customerModel->fetchAll("SELECT * FROM `customer`");
	}
}