<?php Ccc::loadClass('Block_Core_Grid_Collection'); ?>
<?php 
class Block_Vendor_Grid extends Block_Core_Grid_Collection
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
		parent::__construct();
	}

	public function getEditUrl($vendor)
	{
		return $this->getUrl('edit',null,['id'=>$vendor->vendorId]);
	}
	
	public function getDeleteUrl($vendor)
	{
		return $this->getUrl('delete',null,['id'=>$vendor->vendorId]);
	}
	public function prepareActions()
	{
		$this->addAction([
			['title'=>'Edit','method'=>'getEditUrl'],
			['title'=>'Delete','method'=>'getDeleteUrl']
			],'actions');
		return $this;
	}

	public function prepareCollections()
	{
		$this->addCollection([$this->getVendors()],'collection');
	}

	public function prepareColumns()
	{
		$this->addColumn([
			'Venor Id','First Name', 'Last Name','Email','Phone','Status','Created Date','Updated Date','Address Id','Address','Postal Code','City','State','Country'],'columns');
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

