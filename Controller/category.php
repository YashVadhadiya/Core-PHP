<?php 
Ccc::loadClass('Controller_Core_Action');
?>
<?php
class Controller_Category extends Controller_Core_Action{
    
    public function gridAction()
    {
        $adapter = new Model_Core_Adapter();
        $categories = $adapter->fetchAll("SELECT * FROM category ORDER BY path");
        $view = $this->getView();
        //var_dump($view);
        //exit();
        $view->addData('categories', $categories);
        $view->setTemplate('view/category/grid.php');
        $view->toHtml();

        //require_once('view/category/grid.php');
    }
    
    public function addAction()
    {
        $adapter = new Model_Core_Adapter();
        $view = $this->getView();
        $view->setTemplate('view/category/add.php');
        $view->toHtml();
        //require_once('view/category/add.php');
        
    }

    public function getCategoryWithPath()
    {
        $adapter = new Model_Core_Adapter();
        $category = [];
        $idName = $adapter->fetchPairs('SELECT categoryId , categoryName FROM category');
        $idPath = $adapter->fetchPairs('SELECT categoryId , path FROM category');
        foreach ($idPath as $categoryId => $path)
        {
            $idArray = explode("/", $path);
            $temp=[];
            foreach($idArray as $key => $id)
            {
                if(array_key_exists($id, $idName)){
                    array_push($temp ,$idName[$id]);
                }   
            }
            $pathArray = implode("/", $temp);
            $category[$categoryId] = $pathArray;   
        }
        return($category);
    }
    
    public function editAction()
    {
        require_once('view/category/edit.php');
    }
    
    public function saveAction()
    {
        $adapter = new Model_Core_Adapter();
        $date = date('Y-m-d H:i:s');

        $categoryId = $_POST['category']['categoryId'];
        $parentId = $_POST['category']['parentId'];
        $path = $_POST['category']['path'];
        $categoryName = $_POST['category']['categoryName'];
        $status = $_POST['category']['status'];
        $createdAt = $date;
        $updatedAt = $date;

        try{
            if(!$categoryId){
                if(!$parentId){
                    $query = "INSERT INTO `category`(`categoryName`, `status`, `createdAt`) VALUES ('$categoryName', '$status', '$createdAt')";
                    $insert = $adapter->insert($query);
                    if(!$insert){
                        throw new Exception("Not inserted", 1);
                    }
                    else{
                        $query1 = "UPDATE category SET path = $insert";
                        $result1 = $adapter->update($query1);
                        if (!$result1) {
                            throw new Exception("path error", 1);
                        }
                    }
                }   else{
                    $query = "INSERT INTO category(categoryName, parentId, status, createdAt) VALUES ('$categoryName', '$parentId', '$status', '$createdAt')";
                    
                    $insert = $adapter->insert($query);
                    if (!$insert) {
                        throw new Exception("parentId error", 1);
                    }
                    else{
                        $query2 = "SELECT path from category where categoryId = '$parentId'";
                        $result2 = $adapter->fetchOne($query2);
                        $output = $result2. '/' .$insert;
                        $query3 = "UPDATE category SET path = '$output' WHERE categoryId = '$insert'";
                        $result3 = $adapter->update($query3);
                        if(!$result3){
                            throw new Exception("update", 1);  
                        }
                    }
                }
                
                $this->redirect('index.php?c=category&a=grid');  
            }
            
            
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }    

    public function deleteAction()
    {
        $adapter = new Model_Core_Adapter();
        $categoryId = $_GET['id'];
        try{
            $result = $adapter->delete("DELETE FROM `category` WHERE `categoryId` = $categoryId");
            if(!$result){
                throw new Exception("Failed to delete", 1);
            }
            $this->redirect('index.php?c=category&a=grid');
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        
    }
    
    
    public function errorAction()
    {
        echo "error";
    }

}
?>