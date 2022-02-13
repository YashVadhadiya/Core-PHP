<?php
Ccc::loadClass('Controller_Core_Action');
?>
<?php
class Controller_Product extends Controller_Core_Action
{

    public function gridAction()
    {
        $adapter = new Model_Core_Adapter();
        $products = $adapter->fetchAll("SELECT * FROM product");
        $view = $this->getView();
        $view->addData('products', $products);
        $view->setTemplate('view/product/grid.php');
        $view->toHtml();
        //require_once('view/product/grid.php');
        
    }

    public function saveAction()
    {
        $adapter = new Model_Core_Adapter();
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d H:i:s');
        $id = $_POST['product']['id'];
        $name = $_POST['product']['name'];
        $status = $_POST['product']['status'];
        $price = $_POST['product']['price'];
        $quantity = $_POST['product']['quantity'];
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
        $adapter = new Model_Core_Adapter();
        $view = $this->getView();
        $view->setTemplate('view/product/add.php');
        $view->toHtml();
        //require_once('view/product/add.php');
        
    }

    public function editAction()
    {
        $adapter = new Model_Core_Adapter();
        if ($_GET['id'])
        {
            $id = $_GET['id'];
            $products = $adapter->fetchRow("SELECT * FROM `product` WHERE `id` = $id");
        }
        $view = $this->getView();
        $view->addData('products', $products);
        $view->setTemplate('view/product/edit.php');
        $view->toHtml();
        //require_once('view/product/edit.php');
        
    }

    public function deleteAction()
    {
        $id = $_GET['id'];
        $adapter = new Model_Core_Adapter();
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