<?php Ccc::loadClass("Model_Core_Row"); ?>
<?php
class Model_Cart_Item extends Model_Core_Row
{

	public function __construct()
	{
		$this->setResourceClassName('Cart_Item_Resource');
		parent::__construct();
	}

	public function getProduct($reload = false)
    {
        $productModel = Ccc::getModel('Product');
        
        if(!$this->productId)
        {
            return $productModel;
        }

        if($this->product && !$reload)
        { 
            return $this->productModel;
        }

        $product = $productModel->fetchRow("SELECT * from product WHERE id = {$this->productId};");
        if(!$product)
        {
            return $this->productModel;
        }
        $this->setProduct($product);
        return $product;
    }

    public function setproduct(Model_Product $product)
    {
        $this->product = $product;
        return $this;
    }
}



