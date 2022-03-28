<?php

Ccc::loadClass('Block_Core_Template');
Ccc::loadClass('Block_Vendor_Edit_Tab');

class Block_Vendor_Edit_Tabs_Personal extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/edit/tabs/personal.php');
	}

	public function getVendor()
	{
		return Ccc::getRegistry('vendor');
	}
}