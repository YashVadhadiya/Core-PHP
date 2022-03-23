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
		$page = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$vendorModel = Ccc::getModel('Vendor');
		$totalCount = $vendorModel->getAdapter()->fetchOne("SELECT count('vendorId') FROM vendor");
		$this->getPager()->execute($totalCount,$page);
		$query = "SELECT v.*, a.* from vendor v left join vendor_address a on v.vendorId = a.vendorId LIMIT {$this->getPager()->getStartLimit()},{$perPageCount};";

		$vendors = $vendorModel->fetchAll($query);
		return $vendors;
	}
}

