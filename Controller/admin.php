<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php
class Controller_Admin extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Admin Grid');
        $content = $this->getLayout()->getContent();
        $adminGrid = Ccc::getBlock('Admin_Grid');
        $content->addChild($adminGrid);
        echo($this->renderLayout());
    }

    public function saveAction()
    {
        $admin = Ccc::getModel('Admin');
        $date = date('Y-m-d H:i:s');
        $getSaveData = $this->getRequest()->getRequest('admin');
        $message = $this->getMessage();
    
        try
        {
            if (!$getSaveData)
            {
                throw new Exception("You can not insert data in admin.");
            }

            $adminId = (int)$this->getRequest()->getRequest('id');
            $admin = Ccc::getModel('Admin')->load($adminId);
            
            if(!$admin)
            {
                $admin = Ccc::getModel('Admin');
                $admin->createdAt = $date;
                $admin->setData($getSaveData);
                $admin->password = md5($getSaveData['password']);
            }
            else
            {
                $admin->setData($getSaveData);
                $admin->updatedAt = $date;
                $admin->password = md5($getSaveData['password']);
            }

            $result = $admin->save();

            if (!$result) 
            {
                throw new Exception("System is not able to update");
            } 
            else 
            {
                $message->addMessage('Updated Successfully.');
                $this->redirect($this->getLayout()->getUrl('grid', 'admin', null, true));
            }
        }
        
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'admin', ['id' => null], true));
        }
    }

    public function addAction()
    {
        $this->setTitle('Admin Add');
        $id = Ccc::getModel('Admin');
        $content = $this->getLayout()->getContent();
        $adminAdd = Ccc::getBlock('Admin_Edit')->setData(['admin' => $id]);
        $content->addChild($adminAdd);
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->setTitle('Admin Edit');
        $message = $this->getMessage();
        try
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if (!$id)
            {
                throw new Exception("Enable to load admin Id.");
            }
            
            $id = Ccc::getModel('Admin')->load($id);
            
            if (!$id) 
            {
                throw new Exception("Invalid Id.");
            }
            
            $content = $this->getLayout()->getContent();
            $adminEdit = Ccc::getBlock('Admin_Edit')->setData(['admin' => $id]);
            $content->addChild($adminEdit);
            $this->renderLayout();
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'admin', null, true));    
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
            $message->addMessage('Deleted Successfully.');
            $this->redirect($this->getLayout()->getUrl('grid', 'admin', null, true));
        }
    }
} 
?>
