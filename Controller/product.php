<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
Ccc::loadClass('Model_Product');


class Controller_Product extends Controller_Core_Action{
    public function gridAction()
    {
        $this->setTitle("Product Grid");
        $content = $this->getLayout()->getContent();
        $productGrid = Ccc::getBlock("Product_Grid");
        $content->addChild($productGrid);
        $this->renderLayout();
    }

     public function indexAction()
    {
        $content = $this->getLayout()->getContent();
        $productGrid = Ccc::getBlock('product_Index');
        $content->addChild($productGrid);
        $this->renderLayout();
    }

    public function gridBlockAction()
    {
         $productGrid = Ccc::getBlock("product_Grid")->toHtml();
         $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
         $response = [
            'status' => 'success',
            'content' => $productGrid,
            'message' => $messageBlock,
         ] ;
        $this->renderJson($response);
    }

    public function addBlockAction()
    {
        $product = Ccc::getModel('product');
        Ccc::register('product',$product);
        $media = $product->getMedias();
        Ccc::register('media',$media);
        $productAdd =$this->getLayout()->getBlock('product_Edit')->toHtml();
        $response = [
            'status' => 'success',
            'content' => $productAdd
        ];
        $this->renderJson($response);
    }

    public function editBlockAction()
    {
        $id = (int) $this->getRequest()->getRequest('id');
            if(!$id)
            {
                throw new Exception("Id not valid.");
            }
            $productModel = Ccc::getModel('product')->load($id);
            $product = $productModel->fetchRow("SELECT * FROM `product` WHERE `id` = $id");
            $media = $product->getMedias();
                
            Ccc::register('product',$product);
            Ccc::register('media',$media);
            if(!$product)
            {
                throw new Exception("unable to load product.");
            }
            $content = $this->getLayout()->getContent();
            $productEdit = Ccc::getBlock("product_Edit")->toHtml();
                $response = [
            'status' => 'success',
            'content' => $productEdit
        ];
        $this->renderJson($response);
    }



    public function addAction()
    {
        $this->setTitle("Product Add");
        $product = Ccc::getModel('Product');
        $content = $this->getLayout()->getContent();
        Ccc::register('product',$product);
      $productAdd = Ccc::getBlock("Product_Edit");//->setData(['product' => $product , 'categoryProductPair' => []]);
      $content->addChild($productAdd);
      $this->renderLayout();    
    }

    public function editAction()
    {

        try 
        {
            $this->setTitle("Product Edit");
            $message = $this->getMessage();
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id)
            {
                throw new Exception("Id not valid.");
            }
            $product = Ccc::getModel('Product')->load($id);
            if(!$product)
            {
                throw new Exception("unable to load product.");
            }
                $content = $this->getLayout()->getContent();
                $productEdit = Ccc::getBlock("Product_Edit");
                $categoryPath = Ccc::getModel('Category');
                $categoryProductPair = $this->getAdapter()->fetchPairs("SELECT entityId,categoryId FROM `category_product` WHERE `productId` = {$id}");

                Ccc::register('product',$product);
                Ccc::register('categoryProductPair',$categoryProductPair);
                Ccc::register('categoryPath',$categoryPath);
            
       
            $content->addChild($productEdit);
            $this->renderLayout();      
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid',null,null,true)); 
        }

    }
        

    public function saveProductAction()
    {
        $message = $this->getMessage();
        $date = date("Y-m-d H:i:s");
        try
        {

            $getSaveData = $this->getRequest()->getPost('product');
            $productId = (int)$this->getRequest()->getRequest('id');
            if (!$getSaveData) 
            {
                return;         
            } 
   
            $product = Ccc::getModel('product')->load($productId);

            if(!$product)
            {
                $product = Ccc::getModel('product');
                $product->setData($getSaveData);
                $product->createdAt = $date;
                $result = $product->save();
            }
            else
            {
                $product->setData($getSaveData);     
                $product->updatedAt = $date;
                $result = $product->save();
            }

            if (!$result)
            {
                throw new Exception("Update Unsuccessfully");
            }
            $message->addMessage('Update Successfully'); 
            $this->redirect($this->getLayout()->getUrl('editBlock','product',['id' => $result->id, 'tab' => 'category'],false));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('addBlock','product',null,true));
        }
    }

    public function saveCategoryAction()
    {
        $message = $this->getMessage();
        try
        {
            $product = Ccc::getModel('Product');
            $categoryProduct = Ccc::getModel('Category_Product');
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $categoryIds = $this->getRequest()->getPost('category');
            $productId = (int)$this->getRequest()->getRequest('id');
            $product->saveCategories($categoryIds,$productId);
            $message->addMessage('Data Added Successfully');
            $this->redirect($this->getLayout()->getUrl('editBlock','product',['tab' => 'media'],false));    
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
         $this->redirect($this->getLayout()->getUrl('editBlock','product',['tab' => 'media'],false));
        }

    }


    public function saveAction()
    {      
        try 
        {
            $productId = $this->saveProductAction();
            $this->saveCategoryAction();
            //$this->saveAddress();
            $this->redirect($this->getLayout()->getUrl('save','product_media',null,true));
        } 
        catch (Exception $e) 
        {
            $this->redirect($this->getLayout()->getUrl('gridBlock','product',null,true));
        }
    }


    public function deleteAction()
    {
        $adapter = $this->getAdapter();
        try 
        {
            $message = $this->getMessage();
            $mediaModel = Ccc::getModel('Product_Media');
            $id = $this->getRequest()->getRequest('id');
            $product = Ccc::getModel('Product')->load($id);

            $query1 = "SELECT imageId,image FROM product c LEFT JOIN `product_media` cm ON c.id = cm.id  WHERE c.productId = $id;";
            $result1 = $adapter->fetchPairs($query1);


            if (!$id) 
            {
                throw new Exception("Invalid Request.");
            }
            
            $delete = $product->delete(['productId' => $id]); 
            if(!$delete)
            {
                throw new Exception("System is unable to  delete.");
            }

            foreach($result1 as $key => $value){
            if($delete)
            {
              unlink($mediaModel->getImagePath() . $value);               }
            }
            $message->addMessage('Delete Successfully.');
            $this->redirect($this->getLayout()->getUrl('gridBlock','product',['id' => null],false));       
        } catch (Exception $e) {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('gridBlock','product',['id' => null],false));           
        }
    }

}