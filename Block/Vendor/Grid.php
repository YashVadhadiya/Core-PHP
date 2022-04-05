<?php Ccc::loadClass('Block_Core_Grid'); ?>
<?php 
class Block_Vendor_Grid extends Block_Core_Grid
{
	public function __construct()
	{
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
		parent::prepareActions();
		$this->setActions([
			['title'=>'Edit','method'=>'getEditUrl'],
			['title'=>'Delete','method'=>'getDeleteUrl']
			]);
		return $this;
	}

	public function prepareCollections()
	{
		parent::prepareCollections();
		return $this->setCollections($this->getVendors());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('vendorId', [
			'title' => 'Vendor Id',
			'type' => 'int',
		]);

		$this->addColumn('firstName',[
			'title' => 'First Name',
			'type' => 'varchar',
		]);

		$this->addColumn('lastName',[
			'title' => 'Last Name',
			'type' => 'varchar',
		]);

		$this->addColumn('email',[
			'title' => 'Email',
			'type' => 'varchar',
		]);

		$this->addColumn('phone',[
			'title' => 'Phone',
			'type' => 'varchar',
		]);

		$this->addColumn('status',[
			'title' => 'Status',
			'type' => 'int',
		]);
		$this->addColumn('address',[
			'title' => 'Address',
			'type' => 'varchar',
		]);

		$this->addColumn('postalCode',[
			'title' => 'Postal Code',
			'type' => 'int',
		]);

		$this->addColumn('city',[
			'title' => 'City',
			'type' => 'varchar',
		]);

		$this->addColumn('state',[
			'title' => 'State',
			'type' => 'varchar',
		]);

		$this->addColumn('country',[
			'title' => 'Country',
			'type' => 'varchar',
		]);

		$this->addColumn('createdAt',[
			'title' => 'Created At',
			'type' => 'datetime',
		]);

		$this->addColumn('updatedAt',[
			'title' => 'Updated At',
			'type' => 'datetime',
		]);

		return $this;
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

