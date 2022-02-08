<?php 
require_once('Model/Core/Adapter.php');
?>
<?php
class Controller_Category{
    public function gridAction()
    {
        require_once('view/category/grid.php');
    }
    
    public function addAction()
    {
        require_once('view/category/add.php');
    }
    
    public function editAction()
    {
        require_once('view/category/edit.php');
    }
    
    public function saveAction()
    {
        $adapter = new Model_Core_Adapter();
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d H:i:s');

        $id = $_POST['id'];
        $name = $_POST['name'];
        $status = $_POST['status'];
        $createdAt = $date;
        $updatedAt = $date;
    try{
        if($id == NULL){
            $query = "INSERT INTO `category`(`name`, `status`, `createdAt`) VALUES ('$name','$status', '$createdAt')";
            
            $result = $adapter->insert($query);
            
            if(!$result){
                throw new Exception("Data in not inserted in category.", 1);
            }
            else{
                $this->redirect('index.php?c=category&a=grid');
            }
            
        }else{
            $query = "UPDATE `category` SET `name`='$name',`status`='$status', `updatedAt`= '$updatedAt' WHERE `id` = $id";
            
            $result = $adapter->query($query);
            
            if(!$result){
                throw new Exception("Data in not updated in category.", 1);
            
            }else{
                $this->redirect('index.php?c=category&a=gridAction');
            }
            }
    
    }catch(Exception $e){
        echo $e->getMessage();
    }
    }    

    public function deleteAction()
    {
        $adapter = new Model_Core_Adapter();
        $id = $_GET['id'];
        try{
            $result = $adapter->delete("DELETE FROM `category` WHERE `id` = $id");
            if(!$result){
                throw new Exception("Failed to delete", 1);
            }
            $this->redirect();
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
            
        }
    public function redirect()
    {
        header('Location: index.php?c=category&a=grid');
    }
    
    public function errorAction()
    {
        echo "error";
    }
}
?>

