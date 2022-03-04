<?php

Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Core_Request");

class Controller_Product extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $productGrid = Ccc::getBlock("Product_Grid");
        $content->addChild($productGrid);
        $this->renderLayout();
        //Ccc::getBlock("Product_Grid")->toHtml();
    }

    public function saveAction()
    {
        $product = Ccc::getModel('Product');
        $date = date("Y-m-d H:i:s");
        $getSaveData = $this->getRequest()->getRequest("product");

        try
        {
            if (!isset($getSaveData)) 
            {
            throw new Exception("You can not insert data in product.", 1);
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
                    throw new Exception("System is not able to insert", 1);
                } 
                else 
                {
                    $this->redirect($this->getUrl("grid", "product", null, true));
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
                    throw new Exception("System is not able to update", 1);
                } 
                else 
                {
                    $this->redirect($this->getUrl("grid", "product", null, true));
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
        $id = Ccc::getModel('Product'); //->load($id);
        $content = $this->getLayout()->getContent();
        $productAdd = Ccc::getBlock("Product_Edit")->addData("product", $id);
        $content->addChild($productAdd);
        $this->renderLayout();
    }

    public function editAction()
    {
        try {
            $id = (int) $this->getRequest()->getRequest("id");
            if (!$id) {
                throw new Exception("Error Processing Request", 1);
            }
            $id = Ccc::getModel('Product')->load($id);
            //$product = $product->fetchRow("SELECT * FROM product WHERE id = $id");
            if (!$id) {
                throw new Exception("Error Processing Request", 1);
            }
            $content = $this->getLayout()->getContent();
            $productEdit = Ccc::getBlock("Product_Edit")->addData("product", $id);
            $content->addChild($productEdit);
            $this->renderLayout();
            //Ccc::getBlock("Product_Edit")->addData("product", $id)->toHtml();
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest("id");
        $product = Ccc::getModel('Product')->load($getDelete);
        
        $query1 = "SELECT imageId,image FROM product p LEFT JOIN product_media pm ON p.id = pm.productId  WHERE p.id = $getDelete;";

        $result1 = $this->getAdapter()->fetchPairs($query1);

        $result = $product->delete();
        
        foreach($result1 as $key => $value){
            if($result)
            {
                unlink($this->getBaseUrl('Media/Product/') . $value);
            }
        }


        if (!$result) 
        {
            echo "error";
        }
        $this->redirect($this->getUrl("grid", "product", null, true));
    }

    public function errorAction()
    {
        echo "error";
    }
}
?>
