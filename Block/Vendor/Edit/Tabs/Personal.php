<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Vendor_Edit_Tab');

class Block_Vendor_Edit_Tabs_Personal extends Block_Core_Edit_Tabs_Content
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