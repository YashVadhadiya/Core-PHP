<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Page extends Controller_Core_Action
{
    public function gridAction()
    {
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
        $message = Ccc::getModel('Core_Message');
        try
        {
            if (!isset($getSaveData)) 
            {
                throw new Exception('You can not insert data in page.', 1);
            }

            if(array_key_exists('pageId', $getSaveData) && $getSaveData['pageId'] == null)
            {
                $page->name = $getSaveData['name'];
                $page->code = $getSaveData['code'];
                $page->content = $getSaveData['content'];
                $page->status = $getSaveData['status'];
                $result = $page->save();

                if (!$result) 
                {
                    throw new Exception('System is not able to insert', 1);
                } 
                else 
                {
                    $message->addMessage('System is able to insert.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'page', null, true));
                }
            }
            else
            {
                $page->load($getSaveData['pageId']);
                $page->pageId = $getSaveData['pageId'];
                $page->name = $getSaveData['name'];
                $page->code = $getSaveData['code'];
                $page->content = $getSaveData['content'];
                $page->status = $getSaveData['status'];
                $page->updatedAt = $date;
                $result = $page->save();

                if (!$result) 
                {
                    throw new Exception('System is not able to update', 1);
                } 
                else 
                {
                    $message->addMessage('Data is update.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'page', null, true));
                }
            }
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'page', null, true));
        }
    }

    public function addAction()
    {
        $id = Ccc::getModel('Page');
        $content = $this->getLayout()->getContent();
        $pageAdd = Ccc::getBlock('Page_Edit')->addData('page', $id);
        $content->addChild($pageAdd);
        $this->renderLayout();
    }

    public function editAction()
    {
        $message = Ccc::getModel('Core_Message');
        try
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if (!$id)
            {
                throw new Exception('Edit is not working', 1);
            }
            
            $id = Ccc::getModel('Page')->load($id);
            
            if (!$id) 
            {
                throw new Exception('This is not page Id', 1);
            }
            $content = $this->getLayout()->getContent();
            $pageEdit = Ccc::getBlock('Page_Edit')->addData('page', $id);
            $content->addChild($pageEdit);
            $this->renderLayout();
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'page', null, true));
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest('id');
        $page = Ccc::getModel('Page')->load($getDelete);
        $message = Ccc::getModel('Core_Message');
        $result = $page->delete();
    
        if ($result)
        {
            $message->addMessage('Deleted page Id.', Model_Core_Message::SUCCESS);
            $this->redirect($this->getUrl('grid', 'page', null, true));
        }
    }
    public function errorAction()
    {
        echo 'error';
    }
} 
?>
