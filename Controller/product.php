<?php

Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Core_Request");

class Controller_Product extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock("Product_Grid")->toHtml();
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
            if (!array_key_exists('id', $getSaveData))
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
        Ccc::getBlock("Product_Add")->toHtml();
    }

    public function editAction()
    {
        try {
            $id = (int) $this->getRequest()->getRequest("id");
            if (!$id) {
                throw new Exception("Error Processing Request", 1);
            }
            $product = Ccc::getModel('Product')->load($id);
            //$product = $product->fetchRow("SELECT * FROM product WHERE id = $id");
            if (!$product) {
                throw new Exception("Error Processing Request", 1);
            }
            Ccc::getBlock("Product_Edit")->addData("product", $product)->toHtml();
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
        $result = $product->delete();
        var_dump($result);
        if ($result) 
        {
            $this->redirect($this->getUrl("grid", "product", null, true));
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}
?>
