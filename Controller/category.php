<?php
Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Core_Request"); 
?>
<?php class Controller_Category extends Controller_Core_Action
{
    public function gridAction()
    {
        global $adapter;
        $categories = $adapter->fetchAll("SELECT * FROM category ORDER BY path ASC");
        $view = $this->getView();
        $view->addData("categories", $categories);
        $view->setTemplate("view/category/grid.php");

        $view->toHtml();
    }

    public function addAction()
    {
        global $adapter;
        $view = $this->getView();
        $view->setTemplate("view/category/add.php");
        $view->toHtml();
    }

    public function getCategoryWithPath()
    {
        global $adapter;
        $category = [];
        $idName = $adapter->fetchPairs("SELECT categoryId , categoryName FROM category");
        $idPath = $adapter->fetchPairs("SELECT categoryId , path FROM category");
        foreach ($idPath as $categoryId => $path)
        {
            $idArray = explode("/", $path);
            $temp = [];
            foreach ($idArray as $key => $id)
            {
                if (array_key_exists($id, $idName))
                {
                    array_push($temp, $idName[$id]);
                }
            }
            $pathArray = implode("/", $temp);
            $category[$categoryId] = $pathArray;
        }
        return $category;
    }

    public function editAction()
    {
        global $adapter;
        $request = new Model_Core_Request();
        $getUpdateData = $request->getRequest('categoryId');
        $id = $getUpdateData;
        $categories = $adapter->fetchRow("SELECT * FROM `category` WHERE `categoryId` = $id");
        $view = $this->getView();
        $view->addData("categories", $categories);
        $view->setTemplate("view/category/edit.php");
        $view->toHtml();
    }

    public function saveAction()
    {
    try {
        if (!isset($_POST['category'])) {
            throw new Exception("Invalid Request.", 1);
        }
        global $adapter;
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d H:i:s');
        
        $categories = $_POST['category'];
        $categoryName = $categories['categoryName'];
        $parentId = $categories['parentId'];
        $status = $categories['status'];
        $createdAt = $date;
        $updatedAt = $date;
        
        if (array_key_exists('id', $categories)) {
            if (!(int)$categories['id']) {
                throw new Exception("Invalid Request.", 1);
            }
            $categoryId = $categories['id'];
            if (!$parentId) {
                
                $parentId = null;
                $this->updatePathIntoCategory($categoryId,$parentId);
            }
            else {
                
                $this->updatePathIntoCategory($categoryId,$parentId);
            }
            
        }
        else {
            if (!$parentId) {
                $query = "INSERT INTO category(categoryName, status, createdAt) VALUES('$categoryName','$status','$createdAt')";
                $result = $adapter->insert($query);
                if(!$result) {
                    throw new Exception("System is unable to insert the record.", 1);
                }
                else {
                    $query3 = "UPDATE category SET path = '$result' WHERE categoryId = '$result'";
                    $result3 = $adapter->update($query3);
                    if(!$result3) {
                        throw new Exception("System is unable to insert the record.", 1);
                    }
                }
            }
            else {
                $query = "INSERT INTO category(categoryName, parentId, status, createdAt) 
                        VALUES('$categoryName','$parentId','$status','$createdAt')";
                $result = $adapter->insert($query);
                if(!$result) {
                    throw new Exception("System is unable to insert the record.", 1);
                }
                else {
                    $query4 = "SELECT path FROM category WHERE categoryId = '$parentId'";
                    $result4 = $adapter->fetchOne($query4);
                    $output = $result4 .'/'. $result;
                    $query5 = "UPDATE category SET path = '$output' WHERE categoryId = '$result'";
                    $result5 = $adapter->update($query5);
                    if (!$result5) {
                        throw new Exception("System is unable to insert the record.", 1);
                    }
                }
            }
            
        }
        $this->redirect("index.php?c=category&a=grid");

    } 

    catch (Exception $e) {
        $this->redirect("index.php?c=category&a=grid");
    }
}

    public function deleteAction()
    {
        $request = new Model_Core_Request();
        global $adapter;
        $getDeleteData = $request->getRequest('categoryId');
        $categoryId = $getDeleteData;
        try
        {
            $result = $adapter->delete("DELETE FROM `category` WHERE `categoryId` = $categoryId");
            if (!$result)
            {
                throw new Exception("Failed to delete", 1);
            }
            $this->redirect("index.php?c=category&a=grid");
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function errorAction()
    {
        echo "error";
    }

    public function updatePathIntoCategory($categoryId, $parentId)
    {
    global $adapter;
    $query = "SELECT path FROM category WHERE categoryId = '$categoryId'";
    $result = $adapter->fetchOne($query);
    
    $output = $result . '/%';
    $path = $adapter->fetchOne("SELECT path FROM category WHERE categoryId = '$parentId'");
    $newPath = $path . '/' . $categoryId;
    $updatePath = $adapter->update("UPDATE category SET path = '$newPath' WHERE categoryId = '$categoryId'");
    $categories = $adapter->fetchAll("SELECT * FROM category WHERE path LIKE('$output') ORDER BY path");
        if(!$categories) 
        { 
            echo 'No others paths found....';
        }
        else {
            foreach ($categories as $categoryId => $category) {
                $newParentId = $category['parentId'];
                $newCategoryId = $category['categoryId'];
                $getParentPath = $adapter->fetchOne("SELECT path FROM category WHERE categoryId='$newParentId'");
                $updatedPath = $getParentPath . '/' . $category['categoryId'];
                $updateResult = $adapter->update("UPDATE category SET path = '$updatedPath' WHERE categoryId = '$newCategoryId'");
            }
        }
    }
} 

/*    public function saveAction()
    {
        global $adapter;
        $date = date("Y-m-d H:i:s");
        $categoryId = $_POST["category"]["categoryId"];
        $parentId = $_POST["category"]["parentId"];
        //$path = $_POST["category"]["path"];
        $categoryName = $_POST["category"]["categoryName"];
        $status = $_POST["category"]["status"];
        $createdAt = $date;
        $updatedAt = $date;
        try
        {
            if (!$categoryId)
            {
                if (!$parentId)
                {
                    $query = "INSERT INTO `category`(`categoryName`, `status`, `createdAt`) VALUES ('$categoryName', '$status', '$createdAt')";
                    $insert = $adapter->insert($query);
                    if (!$insert)
                    {
                        throw new Exception("Not inserted", 1);
                    }
                    else
                    {
                        $query1 = "UPDATE category SET path = $insert WHERE categoryId = '$insert'";
                        $result1 = $adapter->update($query1);
                        if (!$result1)
                        {
                            throw new Exception("path error", 1);
                        }
                    }
                }
                else
                {
                    $query = "INSERT INTO category(categoryName, parentId, status, createdAt) VALUES ('$categoryName', '$parentId', '$status', '$createdAt')";
                    $insert = $adapter->insert($query);
                    if (!$insert)
                    {
                        throw new Exception("parentId error", 1);
                    }
                    else
                    {
                        $query2 = "SELECT path from category where categoryId = '$parentId'";
                        $result2 = $adapter->fetchOne($query2);
                        $output = $result2 . "/" . $insert;
                        $query3 = "UPDATE category SET path = '$output' WHERE categoryId = '$insert'";
                        $result3 = $adapter->update($query3);
                        if (!$result3)
                        {
                            throw new Exception("update", 1);
                        }
                    }
                }
                $this->redirect("index.php?c=category&a=grid");
            }
            else
            {
                /*global $adapter;
                $categories = $_POST['category'];
                $categoryName = $categories['categoryName'];
                $status = $categories['status'];
                $categoryId = $categories['categoryId'];
                $updatedAt = $date;
                $date = date("Y-m-d H:i:s");

                $query = "UPDATE category SET categoryName = '$categoryName', status = '$status', updatedAt = '$updatedAt' WHERE categoryId = $categoryId";
                $result = $adapter->update($query);
            }
            $this->redirect("index.php?c=category&a=grid");
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }*/

?>
