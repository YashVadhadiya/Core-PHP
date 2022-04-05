<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_PaymentMethod_Edit_Tab');

class Block_PaymentMethod_Edit_Tabs_Personal extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/PaymentMethod/edit/tabs/personal.php');
	}

	public function getPaymentMethod()
	{
		return Ccc::getRegistry('paymentMethod');
	}
}