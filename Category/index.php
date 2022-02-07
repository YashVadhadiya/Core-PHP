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
        $id = $_POST['id'];
        $name = $_POST['name'];
        $status = $_POST['status'];
        $updatedAt = date('Y-m-d H:i:s');
    try{
        if($id == NULL){
            $query = "INSERT INTO `category`(`name`, `status`) VALUES ('$name','$status')";
            
            $result = $adapter->insert($query);
            
            if(!$result){
                throw new Exception("Data in not inserted in category.", 1);
            }
            else{
                $this->redirect('index.php?a=gridAction');
            }
            
        }else{
            $query = "UPDATE `category` SET `name`='$name',`status`='$status', `updatedAt`= '$updatedAt' WHERE `id` = $id";
            
            $result = $adapter->query($query);
            
            if(!$result){
                throw new Exception("Data in not updated in category.", 1);
            
            }else{
                $this->redirect('index.php?a=gridAction');
            }
            }
    
}catch(Exception $e){
        echo $e->getMessage();
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
        $adapter = new Adapter();
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
        header('Location: index.php?a=gridAction');
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

