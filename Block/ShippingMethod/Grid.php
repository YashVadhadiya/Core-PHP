<?php 
Ccc::loadClass('Block_Core_Grid');
class Block_ShippingMethod_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($shippingMethod)
	{
		return $this->getUrl('edit',null,['id'=>$shippingMethod->methodId]);
	}
	
	public function getDeleteUrl($shippingMethod)
	{
		return $this->getUrl('delete',null,['id'=>$shippingMethod->methodId]);
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
		return $this->setCollections($this->getShippingMethods());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('methodId', [
			'title' => 'Shipping Method Id',
			'type' => 'int',
		]);

		$this->addColumn('name',[
			'title' => 'Name',
			'type' => 'varchar',
		]);

		$this->addColumn('note',[
			'title' => 'Note',
			'type' => 'varchar',
		]);

		$this->addColumn('price',[
			'title' => 'Price',
			'type' => 'float',
		]);

		$this->addColumn('status',[
			'title' => 'Status',
			'type' => 'int',
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


	public function getShippingMethods()
	{
		$shippingMethod = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('rpp',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$shippingMethodModel = Ccc::getModel('ShippingMethod');
		$totalCount = $shippingMethodModel->getAdapter()->fetchOne("SELECT count('shippingMethodId') FROM `shipping_method`");
		$this->getPager()->execute($totalCount,$shippingMethod);
		$shippingMethods = $shippingMethodModel->fetchAll("SELECT * FROM `shipping_method` LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $shippingMethods;
	}
}
