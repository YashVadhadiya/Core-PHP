<?php

Ccc::loadClass('Model_Core_Row');
class Model_Category extends Model_Core_Row
{
    protected $medias;
    protected $base;
    protected $thumb;
    protected $small;
    protected $gallery;
    protected $products; 

    public function getMedias($reload = false)
    {
        $mediasModel = Ccc::getModel('Category_Media');
        
        if(!$this->categoryId)
        {
            return $mediasModel;
        }

        if($this->medias && !$reload)
        { 
            return $this->medias;
        }
        $medias = $mediasModel->fetchAll("SELECT * from category_media");
        if(!$medias)
        {
            return $mediasModel;
        }
        //$this->setMedias($medias);
        return $medias;
    }

    public function setMedias(Model_Category_Media $medias)
    {
        $this->medias = $medias;
        return $this;
    }


    public function getBase($reload = false)
    {
        $baseModel = Ccc::getModel('Category_Media');
        
        if(!$this->categoryId)
        {
            return $baseModel;
        }

        if($this->base && !$reload)
        { 
            return $this->base;
        }
        $base = $baseModel->fetchRow("SELECT * from category_media WHERE base = 1");
        if(!$base)
        {
            return $baseModel;
        }
        $this->setBase($base);
        return $base;
    }

    public function setBase(Model_Category_Media $base)
    {
        $this->base = $base;
        return $this;
    }


    public function getThumb($reload = false)
    {
        $thumbModel = Ccc::getModel('Category_Media');
        
        if(!$this->categoryId)
        {
            return $thumbModel;
        }

        if($this->thumb && !$reload)
        { 
            return $this->thumb;
        }
        $thumb = $thumbModel->fetchRow("SELECT * from category_media WHERE thumb = 1");
        if(!$thumb)
        {
            return $thumbModel;
        }
        $this->setThumb($thumb);
        return $thumb;
    }

    public function setThumb(Model_Category_Media $thumb)
    {
        $this->thumb = $thumb;
        return $this;
    }


    public function getSmall($reload = false)
    {
        $smallModel = Ccc::getModel('Category_Media');
        
        if(!$this->categoryId)
        {
            return $smallModel;
        }

        if($this->small && !$reload)
        { 
            return $this->small;
        }
        $small = $smallModel->fetchRow("SELECT * from category_media WHERE small = 1");
        if(!$small)
        {
            return $smallModel;
        }
        $this->setSmall($small);
        return $small;
    }

    public function setSmall(Model_Category_Media $small)
    {
        $this->small = $small;
        return $this;
    }


    public function getGallery($reload = false)
    {
        $galleryModel = Ccc::getModel('Category_Media');
        
        if(!$this->categoryId)
        {
            return $galleryModel;
        }

        if($this->gallery && !$reload)
        { 
            return $this->gallery;
        }
        $gallery = $galleryModel->fetchRow("SELECT * from category_media WHERE gallery = 1");
        if(!$gallery)
        {
            return $galleryModel;
        }
        $this->setGallery($gallery);
        return $gallery;
    }

    public function setGallery(Model_Category_Media $gallery)
    {
        $this->gallery = $gallery;
        return $this;
    }


    public function getProducts($reload = false)
    {
        $productsModel = Ccc::getModel('Product');
        
        if(!$this->id)
        {
            return $productsModel;
        }

        if($this->products && !$reload)
        { 
            return $this->products;
        }
        $products = $productsModel->fetchAll("SELECT * from product WHERE id = {$this->id}");

        if(!$products)
        {
            return $productsModel;
        }
        $this->setProducts($products);
        return $products;
    }

    public function setProducts(Model_Category_Product $products)
    {
        $this->products = $products;
        return $this;
    }

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DEFAULT = 1;
    const STATUS_ENABLED_LBL = 'Enabled';
    const STATUS_DISABLED_LBL = 'Disabled';   

    public function __construct()
    {
        $this->setResourceClassName('Category_Resource');
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
}

