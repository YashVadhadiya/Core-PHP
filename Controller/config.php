<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php
class Controller_Config extends Controller_Core_Action
{
    public function indexAction()
    {
        $content = $this->getLayout()->getContent();
        $configGrid = Ccc::getBlock('Config_Index');
        $content->addChild($configGrid);
        $this->renderLayout();
    }

    public function gridBlockAction()
    {
       $configGrid = Ccc::getBlock("Config_Grid")->toHtml();
       $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
       $response = [
        'status' => 'success',
        'content' => $configGrid,
        'message' => $messageBlock,
    ] ;
    $this->renderJson($response);
}

public function addBlockAction()
{
    $config = Ccc::getModel('config');
    Ccc::register('config',$config);
    $configAdd =$this->getLayout()->getBlock('Config_Edit')->toHtml();
    $response = [
        'status' => 'success',
        'content' => $configAdd
    ];
    $this->renderJson($response);
}

public function editBlockAction()
{
    $id = (int) $this->getRequest()->getRequest('id');
    if(!$id)
    {
        throw new Exception("Id not valid.");
    }
    $configModel = Ccc::getModel('config')->load($id);
    $config = $configModel->fetchRow("SELECT * FROM `config` WHERE `configId` = $id");
    Ccc::register('config',$configModel);
    
    if(!$config)
    {
        throw new Exception("unable to load config.");
    }
    $content = $this->getLayout()->getContent();
    $configEdit = Ccc::getBlock("Config_Edit")->toHtml();
    $response = [
        'status' => 'success',
        'content' => $configEdit
    ];
    $this->renderJson($response);
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
            $config->createdAt = $date;
            $config->setData($getSaveData);
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
            $this->redirect($this->getLayout()->getUrl('gridBlock', 'config', null, false));
        }
    }
    catch (Exception $e) 
    {
        $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
        $this->redirect($this->getLayout()->getUrl('gridBlock', 'config', ['configId' => null], false));           
    }
}

public function deleteAction()
{
    $getDelete = $this->getRequest()->getRequest('id');
    $config = Ccc::getModel('Config')->load($getDelete);
    $result = $config->delete();
    $message = $this->getMessage();
    
    if ($result)
    {
        $message->addMessage('Deleted Successfully.');
        $this->redirect($this->getLayout()->getUrl('gridBlock', 'config', null, false));
    }
}
} 
?>
