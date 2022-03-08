<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Product_Edit extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/product/edit.php');
	}
	public function getProduct()
	{
		return $this->getData('product');
	}

	public function getCategoryWithPath()
	{
		Ccc::loadClass('Controller_Category');
		$categoryModel = new Controller_Category();
		$categoryPath = $categoryModel->getCategoryWithPath();
		return $categoryPath;
	}

	public function getCategories()
	{
		$categoryModel = Ccc::getModel('Category');
		$categories = $categoryModel->fetchAll("SELECT * FROM category WHERE status = 1");
		return $categories;
	}

	public function getCategoryProductPair()
	{		
		return $this->getData('categoryProductPair');
	}

}

?>