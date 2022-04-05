<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_ShippingMethod_Edit_Tab');

class Block_ShippingMethod_Edit_Tabs_Personal extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/ShippingMethod/edit/tabs/personal.php');
	}

	public function getShippingMethod()
	{
		return Ccc::getRegistry('shippingMethod');
	}
}