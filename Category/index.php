<?php 
require_once('Adapter.php');
?>
<?php
class Category{
    public function gridAction()
    {
        require_once('category-grid.php');
    }
    
    public function saveAction()
    {
    $adapter = new Adapter();
    date_default_timezone_set("Asia/Kolkata");
    $date = date('Y-m-d H:i:s');

        $id = $_POST['id'];
        $name = $_POST['name'];
        $status = $_POST['status'];
        $createdAt = $date;
        $updatedAt = $date;

    if($id == NULL){
        
    $result = $adapter->insert("INSERT INTO `category`(`name`, `status`, `createdAt`) VALUES ('$name', '$status', '$createdAt')");
    if ($result) {
        header("location:index.php?a=gridAction");
    } else {
        echo "Error";
    }
}
    else{
    $result = $adapter->update("UPDATE `category` SET `name` = '$name', `status` = '$status', `updatedAt` = '$updatedAt' WHERE `category`.`id` = $id");
    if($result){
             header("location:index.php?a=gridAction");
    }else{
             echo "failed to update data";
    }
 }
    }
    
    public function addAction()
    {
        require_once('category-add.php');
    }
    
    public function editAction()
    {
        require_once('category-update.php');
    }
    
    public function deleteAction()
    {
        $id=$_GET['id'];
        $adapter =new Adapter();
        $result=$adapter->delete("DELETE FROM `category` WHERE `category`.`id` = '$id'");
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

$category = new Category();

$category->$action();
?>