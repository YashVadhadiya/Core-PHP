<?php
Ccc::loadClass('Block_Core_Template');
class Block_Product_Media_Grid extends Block_Core_Template   
{ 
	public function __construct()
	{
		$this->setTemplate('view/product/media/grid.php');
	}

   public function getProductMedias()
   {	
   		$id = Ccc::getFront()->getRequest()->getRequest('id');
   		$productMedia = Ccc::getModel('Product_Media');
		$productMedias = $productMedia->fetchAll("SELECT * FROM product_media WHERE productId = $id");
		return $productMedias;
   }
}