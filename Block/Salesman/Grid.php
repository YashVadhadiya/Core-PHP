<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Salesman_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/salesman/grid.php');
	}

	public function getSalesmans()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$salesmanModel = Ccc::getModel('Salesman');
		$totalCount = $salesmanModel->getAdapter()->fetchOne("SELECT count('salesmanId') FROM salesman");
		$this->getPager()->execute($totalCount,$page);
		$salesmans = $salesmanModel->fetchAll("SELECT * FROM salesman LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $salesmans;
	}
}

