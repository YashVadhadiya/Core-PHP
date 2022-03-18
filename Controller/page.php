<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php
class Controller_Page extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Page Grid');
        $content = $this->getLayout()->getContent();
        $pageGrid = Ccc::getBlock('Page_Grid');
        $content->addChild($pageGrid);
        $this->renderLayout();
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
                $this->redirect($this->getLayout()->getUrl('grid', 'page', ['id' => null], false));
            }
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'page', ['id' => null], false));
        }
    }

    public function addAction()
    {
        $this->setTitle('Page Add');
        $id = Ccc::getModel('Page');
        $content = $this->getLayout()->getContent();
        $pageAdd = Ccc::getBlock('Page_Edit')->setData(['page' => $id]);
        $content->addChild($pageAdd);
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->setTitle('Page Edit');
        $message = $this->getMessage();
        try
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if (!$id)
            {
                throw new Exception('Edit is not working');
            }
            
            $id = Ccc::getModel('Page')->load($id);
            
            if (!$id) 
            {
                throw new Exception('This is not page Id');
            }
            $content = $this->getLayout()->getContent();
            $pageEdit = Ccc::getBlock('Page_Edit')->setData(['page' => $id]);
            $content->addChild($pageEdit);
            $this->renderLayout();
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'page', null, true));
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
            $this->redirect($this->getLayout()->getUrl('grid', 'page', null, false));
        }
    }
} 
?>