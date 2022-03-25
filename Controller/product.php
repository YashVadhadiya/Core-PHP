<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php
class Controller_Product extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Product Grid');
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
        $message = $this->getMessage();
        $categoryProduct = Ccc::getModel('Category_Product');
        $getSave = $this->getRequest()->getRequest('categoryProduct');

        try
        {
            if (!$getSaveData)
            {
                throw new Exception("You can not insert data in product.");
            }

            if (array_key_exists('id', $getSaveData) && $getSaveData['id'] == null)
            {
                $categoryIds = $getSaveData['category'];
                $product->name = $getSaveData['name'];
                $product->status = $getSaveData['status'];
                $product->price = $getSaveData['price'];
                $product->tax = $getSaveData['tax'];
                $product->quantity = $getSaveData['quantity'];
                $product->cost = $getSaveData['cost'];
                $product->discount = $getSaveData['discount'];
                $product->discountMode = $getSaveData['discountMode'];
                $product->sku = $getSaveData['sku'];
                $product->createdAt = $date;
                $result = $product->save();
                $result = $result->id;
                $product->saveCategories($categoryIds, $result);

                if (!$result) 
                {
                    throw new Exception("System is not able to insert.");
                } 
                else 
                {
                    $message->addMessage('Inserted Succesfully.');
                    $this->redirect($this->getLayout()->getUrl('grid', 'product', null, false));
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
                $product->tax = $getSaveData['tax'];
                $product->quantity = $getSaveData['quantity'];
                $product->cost = $getSaveData['cost'];
                $product->discount = $getSaveData['discount'];
                $product->discountMode = $getSaveData['discountMode'];
                $product->sku = $getSaveData['sku'];
                $product->updatedAt = $date;
                $result = $product->save();
                $productId = $result;

                $product->saveCategories($categoryIds);
                
                if (!$result) 
                {
                    throw new Exception("System is not able to update.");
                } 
                else 
                {
                    $message->addMessage('Updated Successfully.');
                    $this->redirect($this->getLayout()->getUrl('grid', 'product', null, false));
                }
            }
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'product', ['id' => null], false));
        }
    }

    public function addAction()
    {
        $this->setTitle('Product Add');
        $id = Ccc::getModel('Product');
        $content = $this->getLayout()->getContent();
        $productAdd = Ccc::getBlock('Product_Edit')->setData(['product' => $id, 'categoryProductPair' => []]);
        $content->addChild($productAdd);
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->setTitle('Product Edit');
        $message = $this->getMessage();
        try {

            $id = (int) $this->getRequest()->getRequest('id');
            if (!$id) 
            {
                throw new Exception("Error Processing Invalid ID.");
            }
            $product = Ccc::getModel('Product')->load($id);
            $categoryProduct = Ccc::getModel('Category_Product')->fetchAll("SELECT categoryId FROM category_product WHERE productId = $id");

            if (!$product) 
            {
                throw new Exception("Error Processing Invalid ID.");
            }
            $content = $this->getLayout()->getContent();
            $productEdit = Ccc::getBlock('Product_Edit');
            $categoryPath = Ccc::getModel('Category');
            $productEdit->setData(['product' => $product, 'categoryProductPair' => $this->getAdapter()->fetchPairs("SELECT entityId, categoryId FROM category_product WHERE productId = {$id}"), 'categoryPath' => $categoryPath]);
            $content->addChild($productEdit);
            $this->renderLayout();
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'product', null, true));
        }
    }

    public function deleteAction()
    {
        $mediaModel = Ccc::getModel('Product_Media');
        $getDelete = $this->getRequest()->getRequest('id');
        $product = Ccc::getModel('Product')->load($getDelete);
        $message = $this->getMessage();
        $query1 = "SELECT imageId,image FROM product p LEFT JOIN product_media pm ON p.id = pm.productId  WHERE p.id = $getDelete;";
        $result1 = $this->getAdapter()->fetchPairs($query1);
        $result = $product->delete();
        foreach($result1 as $key => $value)
        {
            if($result)
            {
                unlink($mediaModel->getImagePath() . $value);
            }
        }

        if (!$result) 
        {
            echo 'error';
        }
        $message->addMessage('Deleted Successfully.');
        $this->redirect($this->getLayout()->getUrl('grid', 'product', null, false));
    }
}
?>
