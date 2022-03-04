<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Admin extends Controller_Core_Action
{

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
        $message = Ccc::getModel('Core_Message');
    
        try
        {
            if (!isset($getSaveData)) 
            {
                $message->addMessage('You can not insert data in admin.', Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid', 'admin', null, true));
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
                    $message->addMessage('System is not able to insert.', Model_Core_Message::ERROR);
                    $this->redirect($this->getUrl('grid', 'admin', null, true));
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
                    $message->addMessage('System is not able to update.', Model_Core_Message::ERROR);
                    $this->redirect($this->getUrl('grid', 'admin', null, true));
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
            echo $e->getMessage();
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
            $message = Ccc::getModel('Core_Message');
            $id = (int) $this->getRequest()->getRequest('id');
            if (!$id)
            {
                $message->addMessage('Enable to load admin Id.', Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid', 'admin', null, true));
            }
            
            $id = Ccc::getModel('Admin')->load($id);
            
            if (!$id) 
            {
                $message->addMessage('Invalid Id.', Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid', 'admin', null, true));
            }
            
            $content = $this->getLayout()->getContent();
            $adminEdit = Ccc::getBlock('Admin_Edit')->addData('admin', $id);
            $content->addChild($adminEdit);
            $this->renderLayout();
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest('id');
        $admin = Ccc::getModel('Admin')->load($getDelete);
        $result = $admin->delete();
        $message = Ccc::getModel('Core_Message');
        if ($result)
        {
            $message->addMessage('Admin id is deleted.', Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'admin', null, true));
        }
    }
    public function errorAction()
    {
        echo 'error';
    }
} 
?>
