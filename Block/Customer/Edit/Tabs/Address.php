<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Customer_Edit_Tab');

class Block_Customer_Edit_Tabs_Address extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/customer/edit/tabs/address.php');
	}

	public function getBillingAddress()
	{
		return Ccc::getRegistry('customerBillingAddress');
	}

	public function getShippingAddress()
	{
		return Ccc::getRegistry('customerShippingAddress');
	}
	public function getCustomer()
	{
		return Ccc::getRegistry('customer');
	}
}