<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Vendor_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
	}

	public function getVendors()
	{
		$vendor = Ccc::getModel('Vendor');
		$vendors = $vendor->fetchAll("SELECT v.*, a.* from vendor v left join vendor_address a on v.vendorId = a.vendorId;");
		return $vendors;
	}
}

