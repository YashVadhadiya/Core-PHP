<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Page_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/page/grid.php');
	}

	public function getpages()
	{
		$page = Ccc::getModel('Page');
		$pages = $page->fetchAll("SELECT * FROM page");
		return $pages;
	}
}

?>