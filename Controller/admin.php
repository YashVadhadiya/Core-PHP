<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Admin extends Controller_Core_Action
{
    /*public function testAction()
    {
        echo "<pre>";
        $adminSession = Ccc::getModel('Admin_Session');
        $coreSession = Ccc::getModel('Core_Session');
        $message1 = Ccc::getModel('Core_Message');
        $message = $this->getMessage();
        print_r($message);
        print_r($message1);

        $adminMessage = Ccc::getModel('Admin_Message');
        $adminMessage = $this->getMessage();
        print_r($adminMessage);

        $adminMessage->addMessage("helloooo");
        //$adminMessage->addMessage("heoo");

        print_r($adminSession);
        print_r($coreSession);
        print_r($_SESSION);
    }*/

    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $adminGrid = Ccc::getBlock('Admin_Grid');
        $content->addChild($adminGrid);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $admin = Ccc::getModel('Admin');
        $date = date('Y-m-d H:i:s');
        $getSaveData = $this->getRequest()->getRequest('admin');
        $message = $this->getMessage();
    
        try
        {
            if (!isset($getSaveData)) 
            {
                throw new Exception("You can not insert data in admin.", 1);
            }

            if(array_key_exists('id', $getSaveData) && $getSaveData['id'] == null)
            {
                $admin->firstName = $getSaveData['firstName'];
                $admin->lastName = $getSaveData['lastName'];
                $admin->email = $getSaveData['email'];
                $admin->password = $getSaveData['password'];
                $admin->status = $getSaveData['status'];
                $result = $admin->save();

                if (!$result) 
                {
                    throw new Exception("System is not able to insert.", 1);
                } 
                else 
                {
                    $message->addMessage('Data inserted successful.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'admin', null, true));
                }
            }
            else
            {
                $admin->load($getSaveData['id']);
                $admin->id = $getSaveData['id'];
                $admin->firstName = $getSaveData['firstName'];
                $admin->lastName = $getSaveData['lastName'];
                $admin->email = $getSaveData['email'];
                $admin->password = $getSaveData['password'];
                $admin->status = $getSaveData['status'];
                $admin->updatedAt = $date;
                $result = $admin->save();

                if (!$result) 
                {
                    throw new Exception("System is not able to update", 1);
                } 
                else 
                {
                    $message->addMessage('Data update successful.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'admin', null, true));
                }
            }
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'admin', null, true));
        }
    }

    public function addAction()
    {
        $id = Ccc::getModel('Admin');
        $content = $this->getLayout()->getContent();
        $adminAdd = Ccc::getBlock('Admin_Edit')->addData('admin', $id);
        $content->addChild($adminAdd);
        $this->renderLayout();
    }

    public function editAction()
    {
        try
        {
            $message = $this->getMessage();
            $id = (int) $this->getRequest()->getRequest('id');
            if (!$id)
            {
                throw new Exception("Enable to load admin Id.", 1);
            }
            
            $id = Ccc::getModel('Admin')->load($id);
            
            if (!$id) 
            {
                throw new Exception("Invalid Id.", 1);
            }
            
            $content = $this->getLayout()->getContent();
            $adminEdit = Ccc::getBlock('Admin_Edit')->addData('admin', $id);
            $content->addChild($adminEdit);
            $this->renderLayout();
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'admin', null, true));    
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest('id');
        $admin = Ccc::getModel('Admin')->load($getDelete);
        $result = $admin->delete();
        $message = $this->getMessage();
        if ($result)
        {
            $message->addMessage('Admin id is deleted.', Model_Core_Message::SUCCESS);
            $this->redirect($this->getUrl('grid', 'admin', null, true));
        }
    }
} 
?>
