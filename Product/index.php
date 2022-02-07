<?php 
require_once('Adapter.php');
?>
<?php
class Product{
    public function gridAction()
    {
        require_once('product-grid.php');
    }
    
    public function saveAction()
    {
        $adapter = new Adapter();
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d H:i:s');
        
        $id = $_POST['id'];
        $name = $_POST['name'];
        $status = $_POST['status'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $createdAt = $date;
        $updatedAt = $date;
        
            try{
            if($id == NULL){
                $query ="INSERT INTO `product`(`name`, `status`, `price`, `quantity`, `createdAt`) VALUES ('$name', '$status', '$price', '$quantity','$createdAt')";

                $result = $adapter->insert($query);

                if(!$result){
                    throw new Exception("System is not able to insert", 1);
                }
                else{
                    $this->redirect('index.php?a=gridAction');
                }
            }else{
                $query = "UPDATE `product` SET `name` = '$name', `status` = '$status', `price` = '$price', `quantity`= '$quantity', `updatedAt` = '$updatedAt' WHERE `product`.`id` = $id";

                $result = $adapter->query($query);

                if(!$result){
                    throw new Exception("System is not able to update", 1);
                }
                else{
                    $this->redirect('index.php?a=gridAction');
                }

            }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    
    public function addAction()
    {
        require_once('product-add.php');
    }
    
    public function editAction()
    {
        require_once('product-update.php');
    }
    
    public function deleteAction()
    {
        $id=$_GET['id'];
        $adapter =new Adapter();
        $result=$adapter->delete("DELETE FROM `product` WHERE `product`.`id` = '$id'");
        var_dump($result);
        if($result)
        {
            header('Location: index.php?a=gridAction');
        }
    }

    public function redirect()
    {
        header('Location: index.php?a=gridAction');
    }
    
    public function errorAction()
    {
        echo "error";
    }
}

$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';

$product = new product();

$product->$action();
?>