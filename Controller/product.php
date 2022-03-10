<?php

Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Product extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $productGrid = Ccc::getBlock('Product_Grid');
        $content->addChild($productGrid);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $product = Ccc::getModel('Product');
        $date = date('Y-m-d H:i:s');
        $getSaveData = $this->getRequest()->getRequest('product');
        $message = Ccc::getModel('Core_Message');
        $categoryProduct = Ccc::getModel('Category_Product');
        $getSave = $this->getRequest()->getRequest('categoryProduct');

        try
        {
            if (!isset($getSaveData))
            {
                throw new Exception("You can not insert data in product.", 1);
            }
            if (array_key_exists('id', $getSaveData) && $getSaveData['id'] == null)
            {
                $categoryIds = $getSaveData['category'];
                $product->name = $getSaveData['name'];
                $product->status = $getSaveData['status'];
                $product->price = $getSaveData['price'];
                $product->quantity = $getSaveData['quantity'];
                $product->sku = $getSaveData['sku'];
                $result = $product->save();
                
                $product->saveCategories($categoryIds, $result);

                if (!$result) 
                {
                    throw new Exception("System is not able to insert.", 1);
                } 
                else 
                {
                    $message->addMessage('Data is inserted.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'product', null, true));
                }
            } 
            else 
            {
                $categoryIds = $getSaveData['category'];

                $product->load($getSaveData['id']);
                $product->id = $getSaveData['id'];
                $product->name = $getSaveData['name'];
                $product->status = $getSaveData['status'];
                $product->price = $getSaveData['price'];
                $product->quantity = $getSaveData['quantity'];
                $product->sku = $getSaveData['sku'];
                $product->updatedAt = $date;
                $result = $product->save();
                $productId = $result;

                $product->saveCategories($categoryIds);
                
                if (!$result) 
                {
                    throw new Exception("System is not able to update.", 1);
                } 
                else 
                {
                    $message->addMessage('Data is updated.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'product', null, true));
                }
            }
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'product', null, true));
        }
    }

    public function addAction()
    {
        $id = Ccc::getModel('Product');
        $content = $this->getLayout()->getContent();
        $productAdd = Ccc::getBlock('Product_Edit')->addData('product', $id);
        $productAdd->addData('categoryProductPair',[]);
        $content->addChild($productAdd);
        $this->renderLayout();
    }

    public function editAction()
    {
        $message = Ccc::getModel('Core_Message');
        try {

            $id = (int) $this->getRequest()->getRequest('id');
            if (!$id) 
            {
                throw new Exception("Error Processing Invalid ID.", 1);
            }
            $product = Ccc::getModel('Product')->load($id);
            $categoryProduct = Ccc::getModel('Category_Product')->fetchAll("SELECT categoryId FROM category_product WHERE productId = $id");

            if (!$product) 
            {
                throw new Exception("Error Processing Invalid ID.", 1);
            }
            $content = $this->getLayout()->getContent();
            $productEdit = Ccc::getBlock('Product_Edit');
            $categoryPath = Ccc::getModel('Category');
            $productEdit->addData("product", $product);
            $productEdit->addData('categoryProductPair',$this->getAdapter()->fetchPairs("SELECT entityId, categoryId FROM category_product WHERE productId = {$id}"));
            $productEdit->addData('categoryPath',$categoryPath);
            $content->addChild($productEdit);
            $this->renderLayout();
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'product', null, true));
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest('id');
        $product = Ccc::getModel('Product')->load($getDelete);
        $message = Ccc::getModel('Core_Message');
        $query1 = "SELECT imageId,image FROM product p LEFT JOIN product_media pm ON p.id = pm.productId  WHERE p.id = $getDelete;";
        $result1 = $this->getAdapter()->fetchPairs($query1);
        $result = $product->delete();
        foreach($result1 as $key => $value)
        {
            if($result)
            {
                unlink($this->getBaseUrl('Media/Product/') . $value);
            }
        }

        if (!$result) 
        {
            echo 'error';
        }
        $message->addMessage('Id deleted successfully.', Model_Core_Message::SUCCESS);
        $this->redirect($this->getUrl('grid', 'product', null, true));
    }

    public function errorAction()
    {
        echo 'error';
    }
}
?>
