<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php
class Controller_Salesman extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Salesman Grid');
        $content = $this->getLayout()->getContent();
        $salesmanGrid = Ccc::getBlock('Salesman_Grid');
        $content->addChild($salesmanGrid);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $salesman = Ccc::getModel('Salesman');
        $date = date('Y-m-d H:i:s');
        $getSaveData = $this->getRequest()->getRequest('salesman');
        $message = $this->getMessage();
    
        try
        {
            if (!$getSaveData)
            {
                throw new Exception("You can not insert data in salesman ID.");
            }

            $salesmanId = (int)$this->getRequest()->getRequest('id');
            $salesman = Ccc::getModel('Salesman')->load($salesmanId);

            if(!$salesman)
            {
                $salesman = Ccc::getModel('Salesman');
                $salesman->setData($getSaveData);
                $salesman->createdAt = $date;
            }
            else
            {
                $salesman->setData($getSaveData);
                $salesman->updatedAt = $date;
            }
                $result = $salesman->save();

            if (!$result) 
            {
                throw new Exception("System is not able to update.");
            } 
            else 
            {
                $message->addMessage('Data Saved.');
                $this->redirect($this->getUrl('grid', 'salesman', null, true));
            }
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'salesman', null, true));        
        }
    }

    public function addAction()
    {
        $this->setTitle('Salesman Add');
        $id = Ccc::getModel('Salesman');
        $content = $this->getLayout()->getContent();
        $salesmanAdd = Ccc::getBlock('Salesman_Edit')->setData(['salesman' => $id]);
        $content->addChild($salesmanAdd);
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->setTitle('Salesman Edit');
        $message = $this->getMessage();
        try
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if (!$id)
            {
                throw new Exception("Edit is not working.");
            }
            
            $id = Ccc::getModel('Salesman')->load($id);
            
            if (!$id) 
            {
                throw new Exception("This is not salesman Id.");
            }
            $content = $this->getLayout()->getContent();
            $salesmanEdit = Ccc::getBlock('Salesman_Edit')->setData(['salesman' => $id]);
            $content->addChild($salesmanEdit);
            $this->renderLayout();
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'salesman', null, true));
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest('id');
        $salesman = Ccc::getModel('Salesman')->load($getDelete);
        $message = $this->getMessage();
        $result = $salesman->delete();
    
        if ($result)
        {
            $message->addMessage('Deleted Successfully.');
            $this->redirect($this->getUrl('grid', 'salesman', null, true));
        }
    }
} 
?>
