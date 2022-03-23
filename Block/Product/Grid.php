<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Product_Grid extends Block_Core_Template{
	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
	}

	public function getProducts()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$productModel = Ccc::getModel('Product');
		$totalCount = $productModel->getAdapter()->fetchOne("SELECT count('productId') FROM product");
		$this->getPager()->execute($totalCount,$page);
		
		$query = "SELECT p.*,b.image AS baseImage,t.image AS thumbImage,s.image AS smallImage FROM product p LEFT JOIN product_media b ON p.id = b.productId AND (b.base = 1) LEFT JOIN product_media t ON p.id = t.productId AND (t.thumb = 1) LEFT JOIN product_media s ON p.id = s.productId AND (s.small = 1) LIMIT {$this->getPager()->getStartLimit()},{$perPageCount};";

		$products = $productModel->fetchAll($query);
		return $products;
	}
}

