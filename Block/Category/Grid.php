<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Category_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
	}

	public function getCategories()
	{
		$category = Ccc::getModel('Category');
		$categories = $category->fetchAll("SELECT * FROM category ORDER BY path ASC");
		return $categories;
	}

	public function getCategoryWithPath()
	{
		Ccc::loadClass('Controller_Category');
		$category = new Controller_Category();
		$categoryPath = $category->getCategoryWithPath();
		return $categoryPath;
	}

}

?>