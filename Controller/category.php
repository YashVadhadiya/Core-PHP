<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php
class Controller_Category extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Category Grid');
        $content = $this->getLayout()->getContent();
        $categoryGrid = Ccc::getBlock("Category_Grid");
        $content->addChild($categoryGrid);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $this->setTitle('Category Add');
        $category = Ccc::getModel('Category');
        $message = $this->getMessage();
        $date = date('Y-m-d H:i:s');
        $getSaveData = $this->getRequest()->getRequest('category');
        try 
        {
            if (!$this->getRequest()->getRequest('category')) 
            {
                throw new Exception("Error in category.");
            }
            $categoryId = $getSaveData['categoryId'];
            $categoryName = $getSaveData['categoryName'];
            $parentId = $getSaveData['parentId'];
            $status = $getSaveData['status'];
            $createdAt = $date;
            $updatedAt = $date;
            
            if (array_key_exists('categoryId', $getSaveData) && $getSaveData['categoryId'] != null) 
            {
                if (!(int)$getSaveData['categoryId']) 
                {
                    throw new Exception("Invalid Id.");
                }
                
                $categoryId = $getSaveData['categoryId'];
                if (!$parentId) 
                {
                    $category->load($categoryId);
                    $category->categoryId = $categoryId;
                    $category->categoryName = $categoryName;
                    $category->parentId = null;
                    $category->status = $status;
                    $category->updatedAt = $date;
                    $updateResult = $category->save();

                    if(!$updateResult) 
                    {
                        throw new Exception("Error Processing Request in update category.");
                    }
                    $parentId = null;
                    $this->updatePathIntoCategory($categoryId, $parentId);

                }
                else 
                {
                    $category->load($categoryId);
                    $category->categoryId = $categoryId;
                    $category->categoryName = $categoryName;
                    $category->parentId = $parentId;
                    $category->status = $status;
                    $category->updatedAt = $date;
                    $result = $category->save();

                    if(!$result) 
                    {
                        throw new Exception("Error Processing Request in result category.");
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
                    $category->createdAt = $date;
                    $resultCategoryName = $category->save();
                    $resultCategoryName = $category->categoryId;

                    if(!$resultCategoryName)
                    {
                        throw new Exception("System is unable to insert the record.");              
                    }
                    else 
                    {
                        $category->load($resultCategoryName);
                        $category->categoryId = $resultCategoryName;
                        $category->path = $resultCategoryName;
                        $result = $category->save();

                        if(!$result) 
                        {
                            throw new Exception("System is unable to insert the record.");
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
                    $resultParentId = $category->categoryId;

                    if(!$resultParentId)
                    {
                        throw new Exception("System is unable to insert the record.");
                    }
                    else 
                    {
                        $query = "SELECT path FROM category WHERE categoryId = '$parentId'";
                        $result = $this->getAdapter()->fetchOne($query);
                        $output = $result .'/'. $resultParentId;

                        $category->load($resultParentId);
                        $category->categoryId = $resultParentId;
                        $category->path = $output;
                        $resultUpdate = $category->save();
                        
                        if (!$resultUpdate) 
                        {
                            throw new Exception("System is unable to insert the record.");
                        }
                    }
                }
            }
            $message->addMessage('Inserted Succesfully.');
            $this->redirect($this->getLayout()->getUrl("grid", "category", null, false));
        } 

        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'category', ['categoryId' => null], false));
        }
    }

    public function getCategoryWithPath()
    {
        $category = Ccc::getModel('Category');
        $idpath = [];
        $query = "SELECT categoryId, categoryName FROM category";
        $idLable = $this->getAdapter()->fetchPairs($query);
      
        if (!$this->getRequest()->getRequest('categoryId')) 
        {
            $query2 = "SELECT categoryId, path FROM category ORDER BY path"; 
        }
        else 
        {
            $categoryId = $this->getRequest()->getRequest('categoryId');
            $excludePath = $this->getAdapter()->fetchOne("SELECT path FROM category WHERE categoryId = '$categoryId'");
            $excludePath = $excludePath . '/%';
            $query2 = "SELECT categoryId,path FROM category WHERE categoryId <> '$categoryId' AND path NOT LIKE('$excludePath') ORDER BY path";  
        }
        $idpath1 = $this->getAdapter()->fetchPairs($query2);
        foreach ($idpath1 as $categoryId => $path) 
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
        $message = $this->getMessage();
        $category = Ccc::getModel('Category');
        $query = "SELECT path FROM category WHERE categoryId = '$categoryId'";
        $result = $this->getAdapter()->fetchOne($query);
        
        $output = $result . '/%';
        $path = $this->getAdapter()->fetchOne("SELECT path FROM category WHERE categoryId = '$parentId'");
        if (!$path) 
        {
            $newPath = $categoryId; 
        }
        else 
        {
            $newPath = $path . '/' . $categoryId;           
        }

        $category->load($categoryId);
        $category->categoryId = $categoryId;
        $category->path = $newPath;
        $updatePath = $category->save();

        $query = "SELECT * FROM category WHERE path LIKE('$output') ORDER BY path";

        $categories = $category->fetchAll($query);
        if(!$categories) 
        { 
            $message->addMessage('Updated Successfully.');
            $this->redirect($this->getLayout()->getUrl('grid', 'category', ['categoryId' => null], true));
        }
        else
        {
            foreach ($categories as $categoryId => $category) 
            {
                $res = $category->getData();
                $parentId = $res['parentId'];
                $categoryId = $res['categoryId'];
                $newParentId = $parentId;
                $newCategoryId = $categoryId;
                $getParentPath = $this->getAdapter()->fetchOne("SELECT path FROM category WHERE categoryId='$newParentId'");
                $updatedPath = $getParentPath . '/' . $categoryId;
                
                $category->load($newCategoryId);
                $category->categoryId = $newCategoryId;
                $category->path = $updatedPath;
                $updateResult = $category->save();
            }
        }
        $message->addMessage('Updated Successfully.');
        $this->redirect($this->getLayout()->getUrl('grid', 'category', ['categoryId' => null], false));   
    }

    public function addAction()
    {
        $this->setTitle('Category Add');
        $categoryId = Ccc::getModel("Category");
        $content = $this->getLayout()->getContent();
        $categoryAdd = Ccc::getBlock("Category_Edit")->setData(['category' => $categoryId]);
        $content->addChild($categoryAdd);
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->setTitle('Category Edit');
        $message = $this->getMessage();
        try{
            $categoryId = (int)$this->getRequest()->getRequest('categoryId');
            
            if(!$categoryId)
            {
                throw new Exception("Error Processing Request in categoryId.");  
            }

            $category = Ccc::getModel('Category')->load($categoryId);
            
            if(!$category)
            {
                throw new Exception("Error Processing Request in category.");
            }

            $content = $this->getLayout()->getContent();
            $categoryEdit = Ccc::getBlock("Category_Edit")->setData(['category' => $category]);
            $content->addChild($categoryEdit);
            $this->renderLayout();            
            }
            catch(Exception $e)
            {
                $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
                $this->redirect($this->getLayout()->getUrl('grid', 'category', null, true));
            }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest("categoryId");
        $category = Ccc::getModel('Category')->load($getDelete);
        $message = $this->getMessage();
        try 
        {
            $query1 = "SELECT imageId, image FROM category c LEFT JOIN category_media cm ON c.categoryId = cm.categoryId  WHERE c.categoryId = $getDelete;";
            
            $result1 = $this->getAdapter()->fetchPairs($query1);
            
            $result = $category->delete();

            foreach($result1 as $key => $value)
            {
                if($result1)
                {
                    unlink($this->getLayout()->getBaseUrl('Media/Category/') . $value);
                }
            }

            if (!$result) 
            {
                throw new Exception("Error Processing Request in not result.");
            }
            $message->addMessage('Deleted Successfully.');
            $this->redirect($this->getLayout()->getUrl("grid", "category", ['categoryId' => null], false));
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'category', null, false));
        }
    }

    }
?>