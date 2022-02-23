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
        $adminModel = Ccc::getModel('Admin_Resource');
        $admin = $adminModel->getRow();
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
            //return $result;
        }
        else
        {
            $admin = $adminModel->load($getSaveData['id']);
            $admin->firstName = $getSaveData["firstName"];
            $admin->lastName = $getSaveData["lastName"];
            $admin->email = $getSaveData["email"];
            $admin->password = $getSaveData["password"];
            $admin->status = $getSaveData["status"];
            $admin->updatedAt = $date;
            $result = $admin->save();
            //return $getSaveData['id'];
        }

        
        /*if (!isset($getSaveData)) 
        {
            throw new Exception("You can not insert data in admin.", 1);
        }
        if (!array_key_exists('id', $getSaveData)):
            $result_admin_insert = $adminModel->insert(["firstName" => $firstName,"lastName" => $lastName, "email" => $email,"password" => $password,"status" => $status]);

            if (!$result_admin_insert):
                throw new Exception("Data is not inserted in admin.",1);
            endif;
            return $result_admin_insert;
        else:
            $result_admin_update = $adminModel->update(["firstName" => $firstName,"lastName" => $lastName,"email" => $email,"password" => $password,"status" => $status,"updatedAt" => $date],["id" => $id]);
        
            if (!$result_admin_update) 
            {
                throw new Exception("Data is not updated in admin.", 1);
            }
            return $id;
        endif;*/
    }

    public function saveAction()
    {
        $adminModel = Ccc::getModel('Admin_Resource');
    
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
            
            $adminModel = Ccc::getModel("Admin_Resource");
            $admin = $adminModel->fetchRow("SELECT * FROM admin WHERE id = $id");
            
            if (!$admin) {
                throw new Exception("This is not admin Id", 1);
            }
            
            Ccc::getBlock("Admin_Edit")->addData("admin", $admin)->toHtml();
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        $adminModel = Ccc::getModel("Admin_Resource");
        $getDelete = $this->getRequest()->getRequest("id");
        $id = $getDelete;
        $result = $adminModel->delete(["id" => $id]);
    
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
