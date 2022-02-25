<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Product_Grid extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
	}

	public function getProducts()
	{
		$product = Ccc::getModel('Product');
		$products = $product->fetchAll("SELECT * FROM product");
		return $products;
	}
}

?>