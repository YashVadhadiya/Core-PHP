<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Customer_Edit_Tab');

class Block_Customer_Edit_Tabs_Personal extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/customer/edit/tabs/personal.php');
	}

	public function getCustomer()
	{
		return Ccc::getRegistry('customer');
	}
}