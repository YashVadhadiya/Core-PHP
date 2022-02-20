<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Category extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock('Category_Grid')->toHtml();
    }

    public function saveAction()
    {
        try 
        {
            if (!$this->getRequest()->getPost('category')) 
            {
                throw new Exception("Error Processing Request in getRequest category.", 1);
            }

            $adapter = new Model_Core_Adapter();
            $categoryModel = Ccc::getModel('Category');
            $date = date('Y-m-d H:i:s');
            $getSaveData = $this->getRequest()->getPost('category');
            $categoryName = $getSaveData['categoryName'];
            $parentId = $getSaveData['parentId'];
            $status = $getSaveData['status'];
            $createdAt = $date;
            $updatedAt = $date;
            
            if (array_key_exists('categoryId', $getSaveData)) 
            {
                if (!(int)$getSaveData['categoryId']) 
                {
                    throw new Exception("Invalid Request.", 1);
                }
                
                $categoryId = $getSaveData['categoryId'];
                if (!$parentId) 
                {
                    $updateResult = $categoryModel->update(['categoryName' => $categoryName, 'status' => $status, 'parentId' => $parentId, 'updatedAt' => $updatedAt], ['categoryId' => $categoryId]);
                    if(!$updateResult) 
                    {
                        throw new Exception("Error Processing Request in updateResult category.", 1);
                    }
                    $parentId = null;
                    $this->updatePathIntoCategory($categoryId, $parentId);
                }
                else 
                {
                    $result = $categoryModel->update(['categoryName' => $categoryName,'status' => $status,'parentId' => $parentId,'updatedAt' => $updatedAt], ['categoryId' => $categoryId]);
                    if(!$result) 
                    {
                        throw new Exception("Error Processing Request in result category.", 1);
                    }
                    $this->updatePathIntoCategory($categoryId, $parentId);
                }
                
            }
            else 
            {
                if (!$parentId) 
                {
                    $resultCategoryName = $categoryModel->insert(['categoryname' => $categoryName, 'status' => $status, 'createdAt' => $createdAt]);
                    if(!$resultCategoryName)
                    {
                        throw new Exception("System is unable to insert the record.", 1);
                    }
                    else 
                    {
                        $result = $categoryModel->update(['path' => $resultCategoryName], ['categoryId' => $resultCategoryName]);
                        if(!$result) 
                        {
                            throw new Exception("System is unable to insert the record.", 1);
                        }
                    }
                }
                else 
                {
                    $resultParentId = $categoryModel->insert(['categoryname' => $categoryName, 'parentId' => $parentId, 'status' => $status, 'createdAt' => $createdAt]);
                    if(!$resultParentId)
                    {
                        throw new Exception("System is unable to insert the record.", 1);
                    }
                    else 
                    {
                        $query = "SELECT path FROM category WHERE categoryId = '$parentId'";
                        $result = $adapter->fetchOne($query);
                        $output = $result .'/'. $resultParentId;
                        $resultUpdate = $categoryModel->update(['path' => $output], ['categoryId' => $resultParentId]);
                        if (!$resultUpdate) 
                        {
                            throw new Exception("System is unable to insert the record.", 1);
                        }
                    }
                }
                
            }
            $this->redirect($this->getUrl("grid", "category", null, true));

        } 

        catch (Exception $e) 
        {
            $this->redirect($this->getUrl("grid", "category", null, true));
        }
    }

    public function getCategoryWithPath()
    {
        $categoryModel = Ccc::getModel('Category');
        $adapter = new Model_Core_Adapter();
        $query = "SELECT categoryId, categoryName FROM category";
        $idLable = $adapter->fetchPairs($query);
      
        if (!$this->getRequest()->getRequest('categoryId')) 
        {
            $query2 = "SELECT categoryId, path FROM category ORDER BY path"; 
        }
        else 
        {
            $categoryId = $this->getRequest()->getRequest('categoryId');
            $excludePath = $adapter->fetchOne("SELECT path FROM category WHERE categoryId = '$categoryId'");
            $excludePath = $excludePath . '/%';
            $query2 = "SELECT categoryId,path FROM category WHERE categoryId <> '$categoryId' AND path NOT LIKE('$excludePath') ORDER BY path";  
        }
        $idpath = $adapter->fetchPairs($query2);
        foreach ($idpath as $categoryId => $path) 
        {
            $idArray = explode("/", $path);
            $temp = [];
            foreach ($idArray as $key => $categoryId) 
            {
                if (array_key_exists($categoryId, $idLable)) 
                {
                    array_push($temp, $idLable[$categoryId]);
                }
            }
            $tempPath = implode(" / ", $temp);
            $idpath[$categoryId] = $tempPath;
        }
        
        return $idpath;
    }

    public function updatePathIntoCategory($categoryId, $parentId)
    {
        $categoryModel = Ccc::getModel('Category');
        $adapter = new Model_Core_Adapter();
        $query = "SELECT path FROM category WHERE categoryId = '$categoryId'";
        $result = $adapter->fetchOne($query);
        
        $output = $result . '/%';
        $path = $adapter->fetchOne("SELECT path FROM category WHERE categoryId = '$parentId'");
        if (!$path) 
        {
            $newPath = $categoryId; 
        }
        else 
        {
            $newPath = $path . '/' . $categoryId;           
        }
        
        $updatePath = $categoryModel->update(['path' => $newPath],[ 'categoryId' => $categoryId]);
        $categories = $adapter->fetchAll("SELECT * FROM category WHERE path LIKE('$output') ORDER BY path");
        if(!$categories) 
        { 
            echo 'No others paths found....';
        }
        else 
        {
            foreach ($categories as $categoryId => $category) 
            {
                $newParentId = $category['parentId'];
                $newCategoryId = $category['categoryId'];
                $getParentPath = $adapter->fetchOne("SELECT path FROM category WHERE categoryId ='$newParentId'");
                $updatedPath = $getParentPath . '/' . $category['categoryId'];
                $updateResult = $categoryModel->update(['path' => $updatedPath], ['categoryId' => $newCategoryId]);
            }
        }
    }

    public function addAction()
    {
        Ccc::getBlock('Category_Add')->toHtml();
    }

    public function editAction()
    {
        try{
            $categoryId = (int)$this->getRequest()->getRequest('categoryId');
            
            if(!$categoryId)
            {
                throw new Exception("Error Processing Request in categoryId.", 1);
            }

            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->fetchRow("SELECT * FROM category WHERE categoryId = $categoryId");
            
            if(!$category)
            {
                throw new Exception("Error Processing Request in category", 1);
            }
            Ccc::getBlock('Category_Edit')->addData('category', $category)->toHtml();
            
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
    }

    public function deleteAction()
    {
        $categoryModel = Ccc::getModel('Category');
        $categoryId = $this->getRequest()->getRequest("categoryId");
        
        try 
        {
            $result = $categoryModel->delete(['categoryId' => $categoryId]);
            if (!$result) 
            {
                throw new Exception("Error Processing Request in not result.", 1);
            }
            $this->redirect($this->getUrl("grid", "category", null, true));
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function errorAction()
    {
        echo "error";
    }

    }
?>
