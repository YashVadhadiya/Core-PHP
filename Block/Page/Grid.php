<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Page_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/page/grid.php');
	}

	public function getPages()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$pageModel = Ccc::getModel('Page');
		$totalCount = $pageModel->getAdapter()->fetchOne("SELECT count('pageId') FROM page");
		$this->getPager()->execute($totalCount,$page);
		$pages = $pageModel->fetchAll("SELECT * FROM page LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $pages;
	}
}

