<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>
<?php
class Controller_Product extends Controller_Core_Action
{

    public function gridAction()
    {
        global $adapter;
        $products = $adapter->fetchAll("SELECT * FROM product");
        $view = $this->getView();
        $view->addData('products', $products);
        $view->setTemplate('view/product/grid.php');
        $view->toHtml();        
    }

    public function saveAction()
    {
        global $adapter;
        $request = new Model_Core_Request();
        $getSaveData = $request->getPost('product');
        $date = date('Y-m-d H:i:s');
        $id = $getSaveData['id'];
        $name = $getSaveData['name'];
        $status = $getSaveData['status'];
        $price = $getSaveData['price'];
        $quantity = $getSaveData['quantity'];
        $createdAt = $date;
        $updatedAt = $date;

        try
        {
            if ($id == NULL)
            {
                $query = "INSERT INTO `product`(`name`, `status`, `price`, `quantity`, `createdAt`) VALUES ('$name', '$status', '$price', '$quantity','$createdAt')";

                $result = $adapter->insert($query);

                if (!$result)
                {
                    throw new Exception("System is not able to insert", 1);
                }
                else
                {
                    $this->redirect('index.php?c=product&a=grid');
                }
            }
            else
            {
                $query = "UPDATE `product` SET `name` = '$name', `status` = '$status', `price` = '$price', `quantity`= '$quantity', `updatedAt` = '$updatedAt' WHERE `product`.`id` = $id";

                $result = $adapter->query($query);

                if (!$result)
                {
                    throw new Exception("System is not able to update", 1);
                }
                else
                {
                    $this->redirect('index.php?c=product&a=grid');
                }

            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        global $adapter;
        $view = $this->getView();
        $view->setTemplate('view/product/add.php');
        $view->toHtml();
    }

    public function editAction()
    {
        $request = new Model_Core_Request();
        global $adapter;
        $getUpdateData = $request->getRequest('id');
        $id = $getUpdateData;
        $products = $adapter->fetchRow("SELECT * FROM `product` WHERE `id` = $id");
        $view = $this->getView();
        $view->addData('products', $products);
        $view->setTemplate('view/product/edit.php');
        $view->toHtml();        
    }

    public function deleteAction()
    {
        $request = new Model_Core_Request();
        global $adapter;
        $getDeleteData = $request->getRequest('id');
        $id = $getDeleteData;
        $result = $adapter->delete("DELETE FROM `product` WHERE `product`.`id` = '$id'");
        var_dump($result);
        if ($result)
        {
            $this->redirect('index.php?c=product&a=grid');
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}
?>