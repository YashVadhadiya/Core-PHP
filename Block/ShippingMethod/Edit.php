<?php 

Ccc::loadClass('Block_Core_Template');
class Block_ShippingMethod_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/shippingMethod/edit.php');
	}
	public function getShippingMethod()
	{
		return $this->getData('shippingMethod');
	}
}

