<?php 

Ccc::loadClass('Block_Core_Edit');
Ccc::loadClass('Block_Vendor_Edit_Tab');
class Block_Vendor_Edit extends Block_Core_Edit
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getSaveUrl()
	{
		return $this->getUrl('save',null,['tab' => null]);
	}
}