<?php 
require_once('Adapter.php');
?>
<?php
class Customer{
    public function gridAction()
    {
        require_once('customer-grid.php');
    }
    
    public function saveAction()
    {
        $adapter = new Adapter();
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d H:i:s');

        $id = $_POST['id'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $status = $_POST['status'];
        $createdAt = $date;
        $updatedAt = $date;

            if($id == NULL)
            {
                $result = $adapter->insert("INSERT INTO `customer`(`firstName`, `lastName`, `email`, `phone`, `status`, `createdAt`) 
                                                        values ('$firstName', '$lastName', '$email', '$phone', '$status', '$createdAt')");

                if ($result)
                {
                    header("location:index.php?a=gridAction"); 
                }
            }

            if($id)
            {
            $result = $adapter->update("UPDATE customer SET firstName= '$firstName', lastName = '$lastName', email = '$email', phone = '$phone', status = '$status', updatedAt = '$updatedAt' WHERE id = '$id'");

                if($result)
                    {
                        header("location:index.php?a=gridAction");
                    }
            }

    }
    
    public function addAction()
    {
        require_once('customer-add.php');
    }
    
    public function editAction()
    {
        require_once('customer-edit.php');
    }
    
    public function deleteAction()
    {
        $id=$_GET['id'];
        $adapter =new Adapter();
        $result=$adapter->delete("DELETE FROM `customer` WHERE `customer`.`id` = '$id'");
        var_dump($result);
        if($result)
        {
            header('Location: index.php?a=gridAction');
        }
    }
    
    public function errorAction()
    {
        echo "error";
    }
}

$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';

$customer = new Customer();

$customer->$action();
?>