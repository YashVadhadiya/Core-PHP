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
            $category = Ccc::getModel('Category');
            $date = date('Y-m-d H:i:s');
            $getSaveData = $this->getRequest()->getPost('category');
            //$category = $category->getRow();

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
                    $category->load($categoryId);
                    $category->categoryName = $categoryName;
                    $category->parentId = $parentId;
                    $category->status = $status;
                    $updateResult = $category->save();

                    if(!$updateResult) 
                    {
                        throw new Exception("Error Processing Request in updateResult category.", 1);
                    }
                    $parentId = null;
                    $this->updatePathIntoCategory($categoryId, $parentId);
                }
                else 
                {
                    $category->load($categoryId);
                    $category->categoryName = $categoryName;
                    $category->parentId = $parentId;
                    $category->status = $status;
                    $category->updatedAt = $date;
                    $result = $category->save();

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
                    $category->categoryName = $categoryName;
                    $category->status = $status;
                    $resultCategoryName = $category->save();

                    if(!$resultCategoryName)
                    {
                        throw new Exception("System is unable to insert the record.", 1);
                    }
                    else 
                    {
                        $category->load($resultCategoryName);
                        $category->path = $resultCategoryName;
                        $result = $category->save();

                        if(!$result) 
                        {
                            throw new Exception("System is unable to insert the record.", 1);
                        }
                    }
                }
                else 
                {
                    $category->categoryName = $categoryName;
                    $category->parentId = $parentId;
                    $category->status = $status;
                    $category->createdAt = $date;
                    $resultParentId = $category->save();

                    if(!$resultParentId)
                    {
                        throw new Exception("System is unable to insert the record.", 1);
                    }
                    else 
                    {
                        $query = "SELECT path FROM category WHERE categoryId = '$parentId'";
                        $result = $adapter->fetchOne($query);
                        $output = $result .'/'. $resultParentId;

                        $category->load($resultParentId);
                        $category->path = $output;
                        $resultUpdate = $category->save();
                        
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
        $category = Ccc::getModel('Category');
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
        $category = Ccc::getModel('Category');
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
        
        $category->load($categoryId);
        $category->path = $newPath;
        $updatePath = $category->save();
        
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

                $category->load($newCategoryId);
                $category->path = $updatedPath;
                $updateResult = $category->save();
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

            $category = Ccc::getModel('Category')->load($categoryId);
            
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
        $getDelete = $this->getRequest()->getRequest("categoryId");
        $category = Ccc::getModel('Category')->load($getDelete);
        
        try 
        {
            $result = $category->delete();
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
