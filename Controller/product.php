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

        try
        {
            if (!isset($getSaveData)) 
            {
                $message->addMessage('You can not insert data in product.', Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid', 'product', null, true));
            }
            if (array_key_exists('id', $getSaveData) && $getSaveData['id'] == null)
            {
                $product->name = $getSaveData['name'];
                $product->status = $getSaveData['status'];
                $product->price = $getSaveData['price'];
                $product->quantity = $getSaveData['quantity'];
                $result = $product->save();

                if (!$result) 
                {
                    $message->addMessage('System is not able to insert.', Model_Core_Message::ERROR);
                    $this->redirect($this->getUrl('grid', 'product', null, true));
                } 
                else 
                {
                    $message->addMessage('Data is inserted.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'product', null, true));
                }
            } 
            else 
            {
                $product->load($getSaveData['id']);
                $product->id = $getSaveData['id'];
                $product->name = $getSaveData['name'];
                $product->status = $getSaveData['status'];
                $product->price = $getSaveData['price'];
                $product->quantity = $getSaveData['quantity'];
                $product->updatedAt = $date;
                $result = $product->save();

                if (!$result) 
                {
                    $message->addMessage('System is not able to update.', Model_Core_Message::ERROR);
                    $this->redirect($this->getUrl('grid', 'product', null, true));
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
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        $id = Ccc::getModel('Product');
        $content = $this->getLayout()->getContent();
        $productAdd = Ccc::getBlock('Product_Edit')->addData('product', $id);
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
                $message->addMessage('Error Processing Invalid ID.', Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid', 'product', null, true));
            }
            $id = Ccc::getModel('Product')->load($id);

            if (!$id) 
            {
                $message->addMessage('Error Processing Invalid ID.', Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid', 'product', null, true));
            }
            $content = $this->getLayout()->getContent();
            $productEdit = Ccc::getBlock('Product_Edit')->addData('product', $id);
            $content->addChild($productEdit);
            $this->renderLayout();
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest('id');
        $product = Ccc::getModel('Product')->load($getDelete);
        
        $query1 = "SELECT imageId,image FROM product p LEFT JOIN product_media pm ON p.id = pm.productId  WHERE p.id = $getDelete;";

        $result1 = $this->getAdapter()->fetchPairs($query1);

        $result = $product->delete();
        $message = Ccc::getModel('Core_Message');
        foreach($result1 as $key => $value){
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
