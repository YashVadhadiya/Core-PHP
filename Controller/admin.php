<?php
Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Core_Request");

class Controller_Admin extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $adminGrid = Ccc::getBlock("Admin_Grid");
        $content->addChild($adminGrid);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $admin = Ccc::getModel('Admin');
        $date = date("Y-m-d H:i:s");
        $getSaveData = $this->getRequest()->getRequest("admin");
    
        try
        {
            if (!isset($getSaveData)) 
            {
            throw new Exception("You can not insert data in admin.", 1);
            }

            if(array_key_exists('id', $getSaveData) && $getSaveData['id'] == null)
            {
                $admin->firstName = $getSaveData["firstName"];
                $admin->lastName = $getSaveData["lastName"];
                $admin->email = $getSaveData["email"];
                $admin->password = $getSaveData["password"];
                $admin->status = $getSaveData["status"];
                $result = $admin->save();

                if (!$result) 
                {
                    throw new Exception("System is not able to insert", 1);
                } 
                else 
                {
                    $this->redirect($this->getUrl("grid", "admin", null, true));
                }
            }
            else
            {
                $admin->load($getSaveData['id']);
                $admin->id = $getSaveData['id'];
                $admin->firstName = $getSaveData["firstName"];
                $admin->lastName = $getSaveData["lastName"];
                $admin->email = $getSaveData["email"];
                $admin->password = $getSaveData["password"];
                $admin->status = $getSaveData["status"];
                $admin->updatedAt = $date;
                $result = $admin->save();

                if (!$result) 
                {
                    throw new Exception("System is not able to update", 1);
                } 
                else 
                {
                    $this->redirect($this->getUrl("grid", "admin", null, true));
                }
            }
        }
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        $id = Ccc::getModel("Admin");
        $content = $this->getLayout()->getContent();
        $adminAdd = Ccc::getBlock("Admin_Edit")->addData("admin", $id);
        $content->addChild($adminAdd);
        $this->renderLayout();
    }

    public function editAction()
    {
        try
        {
            $id = (int) $this->getRequest()->getRequest("id");
            if (!$id)
            {
                throw new Exception("Edit is not working", 1);
            }
            
            $id = Ccc::getModel("Admin")->load($id);
            
            if (!$id) {
                throw new Exception("This is not admin Id", 1);
            }
            
            $content = $this->getLayout()->getContent();
            $adminEdit = Ccc::getBlock("Admin_Edit")->addData("admin", $id);
            $content->addChild($adminEdit);
            $this->renderLayout();
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest("id");
        $admin = Ccc::getModel("Admin")->load($getDelete);
        $result = $admin->delete();
    
        if ($result)
        {
            $this->redirect($this->getUrl("grid", "admin", null, true));
        }
    }
    public function errorAction()
    {
        echo "error";
    }
} 
?>
