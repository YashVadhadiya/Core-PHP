<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php
class Controller_Config extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Config Grid');
        $content = $this->getLayout()->getContent();
        $configGrid = Ccc::getBlock('Config_Grid');
        $content->addChild($configGrid);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $config = Ccc::getModel('Config');
        $date = date('Y-m-d H:i:s');
        $getSaveData = $this->getRequest()->getRequest('config'); 
        $message = $this->getMessage();

        try
        {
            if (!$getSaveData)
            {
            throw new Exception('You can not insert data in config.');
            }

            $configId = (int)$this->getRequest()->getRequest('configId');
            $config = Ccc::getModel('Config')->load($configId);

            if(!$config)
            {
                $config = Ccc::getModel('Config');
                $config->setData($getSaveData);
                $config->createdAt = $date;
            }
            else
            {
                $config->setData($getSaveData);
            }
                $result = $config->save();

            if (!$result) 
            {
                throw new Exception("System is not able to update.");
            } 
            else 
            {
                $message->addMessage('Data Saved.');
                $this->redirect($this->getLayout()->getUrl('grid', 'config', null, false));
            }
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'config', ['configId' => null], false));           
        }
    }

    public function addAction()
    {
        $this->setTitle('Config Add');
        $configId = Ccc::getModel('Config');
        $content = $this->getLayout()->getContent();
        $configAdd = Ccc::getBlock('Config_Edit')->setData(['config' => $configId]);
        $content->addChild($configAdd);
        $this->renderLayout();

    }

    public function editAction()
    {
        $this->setTitle('Config Edit');
        $message = $this->getMessage();
        try
        {
            $configId = (int)$this->getRequest()->getRequest('configId');
            if (!$configId)
            {
                throw new Exception('Edit is not working');
            }
            $config = Ccc::getModel('Config')->load($configId);
            
            if (!$config) 
            {
                throw new Exception("Invalid Id.");
            }
            $content = $this->getLayout()->getContent();
            $configEdit = Ccc::getBlock('Config_Edit')->setData(['config' => $config]);
            $content->addChild($configEdit);
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'config', null, true));        
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest('configId');
        $config = Ccc::getModel('Config')->load($getDelete);
        $result = $config->delete();
        $message = $this->getMessage();
    
        if ($result)
        {
            $message->addMessage('Deleted Successfully.');
            $this->redirect($this->getLayout()->getUrl('grid', 'config', null, false));
        }
    }
} 
?>
