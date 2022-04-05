<?php 
Ccc::loadClass('Block_Core_Grid');
class Block_PaymentMethod_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($paymentMethod)
	{
		return $this->getUrl('edit',null,['id'=>$paymentMethod->methodId]);
	}
	
	public function getDeleteUrl($paymentMethod)
	{
		return $this->getUrl('delete',null,['id'=>$paymentMethod->methodId]);
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
		return $this->setCollections($this->getPaymentMethods());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('methodId', [
			'title' => 'Payment Method Id',
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

	public function getPaymentMethods()
	{
		$paymentMethod = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('rpp',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$paymentMethodModel = Ccc::getModel('PaymentMethod');
		$totalCount = $paymentMethodModel->getAdapter()->fetchOne("SELECT count('paymentMethodId') FROM `payment_method`");
		$this->getPager()->execute($totalCount,$paymentMethod);
		$paymentMethods = $paymentMethodModel->fetchAll("SELECT * FROM `payment_method` LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $paymentMethods;
	}
}
