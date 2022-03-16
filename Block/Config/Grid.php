<?php 
Ccc::loadClass('Block_Core_Template');
class Block_Config_Grid extends Block_Core_Template
{
	protected $pager;

	public function __construct()
	{
		$this->setTemplate('view/config/grid.php');
	}

	public function getConfigs()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$configModel = Ccc::getModel('Config');
		$totalCount = $configModel->getAdapter()->fetchOne("SELECT count('configId') FROM config");
		$this->getPager()->execute($totalCount,$page);
		$configs = $configModel->fetchAll("SELECT * FROM config LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $configs;
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

