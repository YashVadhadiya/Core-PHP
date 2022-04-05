<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Product_Edit_Tab');

class Block_Product_Edit_Tabs_Category extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/product/edit/tabs/category.php');
	}

	public function getProducts()
	{
		return Ccc::getRegistry('product');	
	}

	 public function getCategories()
	{
		$categoryModel = Ccc::getModel('Category');
		$categories = $categoryModel->fetchAll("SELECT *  FROM category  WHERE status = 1");
		return $categories;
	}

	public function getCategoryWithPath()
	{
		Ccc::loadClass('Controller_Category');
		$categoryModel = new Controller_Category();
		$categoryPath = $categoryModel->getCategoryWithPath();
		return $categoryPath;
	}

	public function getCategoryProductPair()
	{	
		$adapter = Ccc::getModel('Core_Row')->getAdapter();
		$id = Ccc::getFront()->getRequest()->getRequest('id');
//		print_r($id);
		$categoryProductPair = $adapter->fetchPairs("SELECT entityId, categoryId FROM `category_product` WHERE `productId` = {$id}");
		return $categoryProductPair;
		//return Ccc::getRegistry('categoryProductPair');
	}

	public function getCategory()
	{
		return Ccc::getRegistry('category');
	}
}