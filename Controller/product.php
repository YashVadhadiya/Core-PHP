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
        $productModel = Ccc::getModel('Product_Resource');
        $product = $productModel->getRow();
        $date = date("Y-m-d H:i:s");
        $getSaveData = $this->getRequest()->getRequest("product");
        /*$productModel = Ccc::getModel('Product_Resource');
        $getSaveData = $this->getRequest()->getRequest("product");
        $date = date("Y-m-d H:i:s");
        $id = $getSaveData["id"];
        $name = $getSaveData["name"];
        $status = $getSaveData["status"];
        $price = $getSaveData["price"];
        $quantity = $getSaveData["quantity"];
        $createdAt = $date;
        $updatedAt = $date;*/

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
                /*$result = $productModel->insert(["name" => $name, "status" => $status, "price" => $price, "quantity" => $quantity, "createdAt" => $createdAt]);*/

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
                $product = $productModel->load($getSaveData['id']);
                $product->name = $getSaveData['name'];
                $product->status = $getSaveData['status'];
                $product->price = $getSaveData['price'];
                $product->quantity = $getSaveData['quantity'];
                $product->updatedAt = $date;
                $result = $product->save();
                //return $getSaveData['id'];
                /*$result = $productModel->update(
                    ["name" => $name,"status" => $status,"price" => $price,"quantity" => $quantity,"updatedAt" => $updatedAt],["id" => $id]);*/

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
            $productModel = Ccc::getModel('Product_Resource');
            $product = $productModel->fetchRow(
                "SELECT * FROM product WHERE id = $id"
            );
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
        $productModel = Ccc::getModel('Product_Resource');
        $getDeleteData = $this->getRequest()->getRequest("id");
        $id = $getDeleteData;
        $result = $productModel->delete(["id" => $id]);
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
