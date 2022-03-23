<?php
Ccc::loadClass('Model_Core_Row');
class Model_Product_Media extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Product_Media_Resource');
		parent::__construct();
	}

	protected $product;
    protected $mediaPath = "Media/Product";

    public function getImageUrl()
    {     
        return Ccc::getBaseUrl($this->mediaPath.'/'.$this->image);
    }

    public function getImagePath()
    {     
        return Ccc::getBasePath($this->mediaPath.'/'.$this->image);
    }


	public function getProduct($reload = false)
    {
        $productModel = Ccc::getModel('Product');
        
        if(!$this->id)
        {
            return $productModel;
        }

        if($this->product && !$reload)
        { 
            return $this->product;
        }
        $product = $productModel->fetchRow("SELECT * from product WHERE id = {$this->id}");
        if(!$product)
        {
            return $productModel;
        }
        $this->setProduct($product);
        return $product;
    }

    public function setProduct(Model_Product $product)
    {
        $this->product = $product;
        return $this;
    }
}