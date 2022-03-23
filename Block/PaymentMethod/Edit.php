<?php 

Ccc::loadClass('Block_Core_Template');
class Block_PaymentMethod_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/paymentMethod/edit.php');
	}
	public function getPaymentMethod()
	{
		return $this->getData('paymentMethod');
	}
}

