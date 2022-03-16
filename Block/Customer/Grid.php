<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Customer_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
	}

	public function getCustomers()
	/*{
		$customer = Ccc::getModel('Customer');
		$customers = $customer->fetchAll("SELECT c.*, a.* from customer c left join address a on c.id = a.customerId where a.billing = 1;");
		return $customers;
	}*/
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$customerModel = Ccc::getModel('Customer');
		$totalCount = $customerModel->getAdapter()->fetchOne("SELECT count('customerId') FROM customer");
		$this->getPager()->execute($totalCount,$page);
		$query = "SELECT c.*, a.* from customer c left join address a on c.id = a.customerId where a.billing = 1 LIMIT {$this->getPager()->getStartLimit()},{$perPageCount};";

		$customers = $customerModel->fetchAll($query);
		return $customers;
	}

	public function getPager()
	{
		return $this->pager;
	}

	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this->pager;
	}
}

