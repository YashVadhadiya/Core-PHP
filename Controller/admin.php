<?php
Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Core_Request");

class Controller_Admin extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock("Admin_Grid")->toHtml();
    }

    protected function saveAdmin()
    {
        $admin = Ccc::getModel('Admin');
        $date = date("Y-m-d H:i:s");
        $getSaveData = $this->getRequest()->getRequest("admin");

        if(!array_key_exists('id', $getSaveData))
        {
            $admin->firstName = $getSaveData["firstName"];
            $admin->lastName = $getSaveData["lastName"];
            $admin->email = $getSaveData["email"];
            $admin->password = $getSaveData["password"];
            $admin->status = $getSaveData["status"];
            $result = $admin->save();
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
        }
    }

    public function saveAction()
    {
        $admin = Ccc::getModel('Admin');
    
        try
        {
            $id = $this->saveAdmin();
            $this->redirect($this->getUrl("grid","admin",null,true));
        }
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        Ccc::getBlock("Admin_Add")->toHtml();
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
            //$admin->fetchRow("SELECT * FROM admin WHERE id = $id");
            
            if (!$id) {
                throw new Exception("This is not admin Id", 1);
            }
            
            Ccc::getBlock("Admin_Edit")->addData("admin", $id)->toHtml();
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
