<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Config extends Controller_Core_Action
{
    public function gridAction()
    {
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
        $message = Ccc::getModel('Core_Message');

        try
        {
            if (!isset($getSaveData)) 
            {
            throw new Exception('You can not insert data in config.', 1);
            }

            if(array_key_exists('configId', $getSaveData) && $getSaveData['configId'] == null)
            {
            $config->name = $getSaveData['name'];
            $config->code = $getSaveData['code'];
            $config->value = $getSaveData['value'];
            $config->status = $getSaveData['status'];
            $config->createdAt = $date;
            $result = $config->save();

            if (!$result) 
                {
                    throw new Exception("You can not insert data in config.", 1);
                } 
            else 
                {
                    $message->addMessage('Data is inserted in config.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'config', null, true));
                }
            }
            else
            {
            $config->load($getSaveData['configId']);
            $config->configId = $getSaveData['configId'];
            $config->name = $getSaveData['name'];
            $config->code = $getSaveData['code'];
            $config->value = $getSaveData['value'];
            $config->status = $getSaveData['status'];
            $result = $config->save();

            if (!$result) 
                {
                    throw new Exception("System is not able to update.", 1);
                } 
                else 
                {
                    $message->addMessage('Data is updated.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'config', null, true));
                }
            }
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'config', null, true));           
        }
    }

    public function addAction()
    {
        $configId = Ccc::getModel('Config');
        $content = $this->getLayout()->getContent();
        $configAdd = Ccc::getBlock('Config_Edit')->addData('config', $configId);
        $content->addChild($configAdd);
        $this->renderLayout();

    }

    public function editAction()
    {
        $message = Ccc::getModel('Core_Message');
        try
        {
            $configId = (int)$this->getRequest()->getRequest('configId');
            if (!$configId)
            {
                throw new Exception('Edit is not working', 1);
            }
            $config = Ccc::getModel('Config')->load($configId);
            
            if (!$config) 
            {
                throw new Exception("This is not config Id.", 1);
            }
            $content = $this->getLayout()->getContent();
            $configEdit = Ccc::getBlock('Config_Edit')->addData('config', $config);
            $content->addChild($configEdit);
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'config', null, true));        
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest('configId');
        $config = Ccc::getModel('Config')->load($getDelete);
        $result = $config->delete();
        $message = Ccc::getModel('Core_Message');
    
        if ($result)
        {
            $message->addMessage('Config Id is deleted.', Model_Core_Message::SUCCESS);
            $this->redirect($this->getUrl('grid', 'config', null, true));
        }
    }
    public function errorAction()
    {
        echo 'error';
    }
} 
?>
