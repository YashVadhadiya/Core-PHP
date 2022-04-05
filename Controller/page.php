<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php
class Controller_Page extends Controller_Core_Action
{
    public function indexAction()
    {
        $content = $this->getLayout()->getContent();
        $pageGrid = Ccc::getBlock('Page_Index');
        $content->addChild($pageGrid);
        $this->renderLayout();
    }

    public function gridBlockAction()
    {
       $pageGrid = Ccc::getBlock("Page_Grid")->toHtml();
       $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
       $response = [
        'status' => 'success',
        'content' => $pageGrid,
        'message' => $messageBlock,
    ] ;
    $this->renderJson($response);
}

public function addBlockAction()
{
    $page = Ccc::getModel('page');
    Ccc::register('page',$page);
    $pageAdd =$this->getLayout()->getBlock('Page_Edit')->toHtml();
    $response = [
        'status' => 'success',
        'content' => $pageAdd
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
    $pageModel = Ccc::getModel('page')->load($id);
    $page = $pageModel->fetchRow("SELECT * FROM `page` WHERE `pageId` = $id");
    Ccc::register('page',$pageModel);
    
    if(!$page)
    {
        throw new Exception("unable to load page.");
    }
    $content = $this->getLayout()->getContent();
    $pageEdit = Ccc::getBlock("Page_Edit")->toHtml();
    $response = [
        'status' => 'success',
        'content' => $pageEdit
    ];
    $this->renderJson($response);
}

public function saveAction()
{
    $page = Ccc::getModel('Page');
    $date = date('Y-m-d H:i:s');
    $getSaveData = $this->getRequest()->getRequest('page');
    $message = $this->getMessage();
    try
    {
        if (!$getSaveData)
        {
            throw new Exception('You can not insert data in page.');
        }

        $pageId = (int)$this->getRequest()->getRequest('id');
        $page = Ccc::getModel('Page')->load($pageId);

        if(!$page)
        {
            $page = Ccc::getModel('Page');
            $page->setData($getSaveData);
            $page->createdAt = $date;
        }
        else
        {
            $page->setData($getSaveData);
            $page->updatedAt = $date;
        }
        $result = $page->save();

        if (!$result) 
        {
            throw new Exception('System is not able to update');
        }
        else 
        {
            $message->addMessage('Data Saved.');
            $this->redirect($this->getLayout()->getUrl('gridBlock', 'page', ['id' => null], false));
        }
    }
    catch (Exception $e) 
    {
        $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
        $this->redirect($this->getLayout()->getUrl('gridBlock', 'page', ['id' => null], false));
    }
}

public function deleteAction()
{
    $getDelete = $this->getRequest()->getRequest('id');
    $page = Ccc::getModel('Page')->load($getDelete);
    $message = $this->getMessage();
    $result = $page->delete();
    
    if ($result)
    {
        $message->addMessage('Deleted Successfully.');
        $this->redirect($this->getLayout()->getUrl('gridBlock', 'page', null, false));
    }
}
} 
?>