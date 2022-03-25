<?php 
Ccc::loadClass('Block_Core_Template');
class Block_Order_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/order/grid.php');
	}

	public function getOrders()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$orderModel = Ccc::getModel('Order');
		$totalCount = $orderModel->getAdapter()->fetchOne("SELECT count('orderId') FROM orders");
		$this->getPager()->execute($totalCount, $page);
		return $orderModel->fetchAll("SELECT * FROM orders LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
	}
}