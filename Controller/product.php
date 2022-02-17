<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

?>
<?php
class Controller_Product extends Controller_Core_Action
{
    public function testAction()
    {
        $adminTable = new Model_Admin();
    }

    public function gridAction()
    {
        Ccc::getBlock('Product_Grid')->toHtml();
        /*$adapter = new Model_Core_Adapter();
        //$adapter = new Model_Core_Adapter();
        $products = $adapter->fetchAll("SELECT * FROM product");
        $view = $this->getView();
        $view->addData('products', $products);
        $view->setTemplate('view/product/grid.php');
        $view->toHtml();        */
    }

    public function saveAction()
    {
        $adapter = new Model_Core_Adapter();
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
                    $this->redirect($this->getUrl('grid','product',null,true));
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
                    $this->redirect($this->getUrl('grid','product',null,true));
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
        Ccc::getBlock('Product_Add')->toHtml();
        /*$adapter = new Model_Core_Adapter();
        $view = $this->getView();
        $view->setTemplate('view/product/add.php');
        $view->toHtml();*/
    }

    public function editAction()
    {
        try{
            $id = (int)$this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception("Error Processing Request", 1);
            }
            $productModel = Ccc::getModel('Product');
            $product = $productModel->fetchRow("SELECT * FROM product WHERE id = $id");
            if(!$product){
                throw new Exception("Error Processing Request", 1);
            }
            Ccc::getBlock('Product_Edit')->addData('product', $product)->toHtml();
            
            
            
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
        /*
        $getUpdateData = $request->getRequest('id');
        $id = $getUpdateData;
        $products = $adapter->fetchRow("SELECT * FROM `product` WHERE `id` = $id");
        $view = $this->getView();
        $view->addData('products', $products);
        $view->setTemplate('view/product/edit.php');
        $view->toHtml();*/
    

    public function deleteAction()
    {
        $request = new Model_Core_Request();
        $adapter = new Model_Core_Adapter();
        $getDeleteData = $request->getRequest('id');
        $id = $getDeleteData;
        $result = $adapter->delete("DELETE FROM `product` WHERE `product`.`id` = '$id'");
        var_dump($result);
        if ($result)
        {
            $this->redirect($this->getUrl('grid','product',null,true));
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}
?>