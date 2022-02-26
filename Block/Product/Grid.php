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
		$products = $product->fetchAll("SELECT p.*,b.imageId AS baseImage,t.imageId AS thumbImage,s.imageId AS smallImage FROM product p LEFT JOIN product_media b ON p.id = b.productId AND (b.base = 1) LEFT JOIN product_media t ON p.id = t.productId AND (t.thumb = 1) LEFT JOIN product_media s ON p.id = s.productId AND (s.small = 1);");
		return $products;
	}
}

?>