<?php

Ccc::loadClass('Model_Core_Row');
class Model_Product extends Model_Core_Row
{
	const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DEFAULT = 1;
    const STATUS_ENABLED_LBL = 'Active';
    const STATUS_DISABLED_LBL = 'InActive'; 

    const DISCOUNT_PRICE = 1;
    const DISCOUNT_PERCENTAGE = 2;
    const DISCOUNT_DEFAULT = 1;
    const DISCOUNT_PERCENTAGE_LBL = 'Discount Percentage'; 
    const DISCOUNT_PRICE_LBL = 'Discount Price'; 
    
    protected $medias;
    protected $base;
    protected $thumb;
    protected $small;
    protected $gallery;

    public function getMedias($reload = false)
    {
        $mediasModel = Ccc::getModel('Product_Media');
        
        if(!$this->productId)
        {
            return $mediasModel;
        }

        if($this->medias && !$reload)
        { 
            return $this->medias;
        }
        $medias = $mediasModel->fetchAll("SELECT * from product_media");
        if(!$medias)
        {
            return $mediasModel;
        }
        $this->setMedias($medias);
        return $medias;
    }

    public function setMedias(Model_Product_Media $medias)
    {
        $this->medias = $medias;
        return $this;
    }

    

    public function getBase($reload = false)
    {
        $baseModel = Ccc::getModel('Product_Media');
        
        if(!$this->productId)
        {
            return $baseModel;
        }

        if($this->base && !$reload)
        { 
            return $this->base;
        }
        $base = $baseModel->fetchRow("SELECT * from product_media WHERE base = 1");
        if(!$base)
        {
            return $baseModel;
        }
        $this->setBase($base);
        return $base;
    }

    public function setBase(Model_Product_Media $base)
    {
        $this->base = $base;
        return $this;
    }

    

    public function getThumb($reload = false)
    {
        $thumbModel = Ccc::getModel('Product_Media');
        
        if(!$this->productId)
        {
            return $thumbModel;
        }

        if($this->thumb && !$reload)
        { 
            return $this->thumb;
        }
        $thumb = $thumbModel->fetchRow("SELECT * from product_media WHERE thumb = 1");
        if(!$thumb)
        {
            return $thumbModel;
        }
        $this->setThumb($thumb);
        return $thumb;
    }

    public function setThumb(Model_Product_Media $thumb)
    {
        $this->thumb = $thumb;
        return $this;
    }

    

    public function getSmall($reload = false)
    {
        $smallModel = Ccc::getModel('Product_Media');
        
        if(!$this->productId)
        {
            return $smallModel;
        }

        if($this->small && !$reload)
        { 
            return $this->small;
        }
        $small = $smallModel->fetchRow("SELECT * from product_media WHERE small = 1");
        if(!$small)
        {
            return $smallModel;
        }
        $this->setSmall($small);
        return $small;
    }

    public function setSmall(Model_Product_Media $small)
    {
        $this->small = $small;
        return $this;
    }

    

    public function getGallery($reload = false)
    {
        $galleryModel = Ccc::getModel('Product_Media');
        
        if(!$this->productId)
        {
            return $galleryModel;
        }

        if($this->gallery && !$reload)
        { 
            return $this->gallery;
        }
        $gallery = $galleryModel->fetchRow("SELECT * from product_media WHERE gallery = 1");
        if(!$gallery)
        {
            return $galleryModel;
        }
        $this->setGallery($gallery);
        return $gallery;
    }

    public function setGallery(Model_Product_Media $gallery)
    {
        $this->gallery = $gallery;
        return $this;
    }

    
	public function __construct()
	{
		$this->setResourceClassName('Product_Resource');
	}

	public function getStatus($key = null)
    {       
        
        $statues = [self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
                    self::STATUS_DISABLED => self::STATUS_DISABLED_LBL];

        if(!$key)
        {
            return $statues;
        }

        if(array_key_exists($key , $statues))
        {
            return $statues[$key];
        }

        return self::STATUS_DEFAULT;
    }

    public function getDiscountMode($key = null)
    {       
        
        $discounts = [self::DISCOUNT_PERCENTAGE => self::DISCOUNT_PERCENTAGE_LBL,
                    self::DISCOUNT_PRICE => self::DISCOUNT_PRICE_LBL,];

        if(!$key)
        {
            return $discounts;
        }

        if(array_key_exists($key , $discounts))
        {
            return $discounts[$key];
        }

        return self::DISCOUNT_DEFAULT;
    }

    public function saveCategories($categoryIds , $productId = null)
    {
        $adapter = new Model_Core_Adapter();
        $query = "DELETE FROM category_product WHERE productId = {$this->id}";
        $adapter->delete($query);   
        if($productId)
        {
            foreach ($categoryIds as $categoryId) 
                {       
                    $categoryProduct = Ccc::getModel('Category_Product');
                    $categoryProduct->productId = $productId;
                    $categoryProduct->categoryId = $categoryId;
                    $categoryProduct->save();
                }

        }
        foreach ($categoryIds as $categoryId) 
        {  
            $categoryProduct = Ccc::getModel('Category_Product');
            $categoryProduct->productId = $this->id;
            $categoryProduct->categoryId = $categoryId;
            $categoryProduct->save();
        }
    }
}

