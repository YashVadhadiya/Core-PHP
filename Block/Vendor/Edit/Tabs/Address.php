<?php

Ccc::loadClass('Block_Core_Template');
Ccc::loadClass('Block_Vendor_Edit_Tab');

class Block_Vendor_Edit_Tabs_Address extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/edit/tabs/address.php');
	}

	public function getVendorAddress()
	{
		return Ccc::getRegistry('vendorAddress');
	}
}