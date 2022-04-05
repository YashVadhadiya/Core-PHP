<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 
class Block_Order_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($customer)
	{
		return $this->getUrl('edit',null,['id'=>$order->orderId]);
	}

	public function getViewOrderUrl($order)
	{
		return $this->getUrl('view',null,['id'=>$order->orderId]);
	}

	public function prepareActions()
	{
		$this->setActions([
			['title'=>'ViewOrder','method'=>'getViewOrderUrl']
			]);
		return $this;
	}

	public function prepareCollections()
	{
	 	$this->setCollections($this->getOrders());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('orderId', [
			'title' => 'Order Id',
			'type' => 'int',
		]);

		$this->addColumn('customerId',[
			'title' => 'Customer Id',
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

		$this->addColumn('taxAmount',[
			'title' => 'Tax Amount',
			'type' => 'float',
		]);

		$this->addColumn('grandTotal',[
			'title' => 'Grand Total',
			'type' => 'float',
		]);

		$this->addColumn('shippingMethodId',[
			'title' => 'Shipping Method Id',
			'type' => 'int',
		]);

		$this->addColumn('shippingAmount',[
			'title' => 'Shipping Amount',
			'type' => 'float',
		]);

		$this->addColumn('paymentMethodId',[
			'title' => 'Payment Method Id',
			'type' => 'int',
		]);

		$this->addColumn('createdAt',[
			'title' => 'Created At',
			'type' => 'datetime',
		]);

		return $this;
	}

	public function getOrders()
	{
		$order = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$orderModel = Ccc::getModel('order');
		$totalCount = $orderModel->getAdapter()->fetchOne("SELECT count('orderId') FROM `orders`");
		$this->getPager()->execute($totalCount,$order);
		$orders = $orderModel->fetchAll("SELECT * FROM `orders` LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $orders;
	}
}