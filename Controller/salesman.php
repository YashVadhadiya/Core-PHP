<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Salesman extends Controller_Core_Action
{
    public function gridAction()
    {
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
            if (!isset($getSaveData)) 
            {
                throw new Exception("You can not insert data in salesman ID.", 1);
            }

            if(array_key_exists('salesmanId', $getSaveData) && $getSaveData['salesmanId'] == null)
            {
                $salesman->firstName = $getSaveData['firstName'];
                $salesman->lastName = $getSaveData['lastName'];
                $salesman->email = $getSaveData['email'];
                $salesman->phone = $getSaveData['phone'];
                $salesman->status = $getSaveData['status'];
                $salesman->percentage = $getSaveData['percentage'];
                $result = $salesman->save();

                if (!$result) 
                {
                    throw new Exception("System is not able to insert.", 1);
                } 
                else 
                {
                    $message->addMessage('Data is inserted.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'salesman', null, true));
                }
            }
            else
            {
                $salesman->load($getSaveData['salesmanId']);
                $salesman->salesmanId = $getSaveData['salesmanId'];
                $salesman->firstName = $getSaveData['firstName'];
                $salesman->lastName = $getSaveData['lastName'];
                $salesman->email = $getSaveData['email'];
                $salesman->phone = $getSaveData['phone'];
                $salesman->status = $getSaveData['status'];
                $salesman->percentage = $getSaveData['percentage'];
                $salesman->updatedAt = $date;
                $result = $salesman->save();

                if (!$result) 
                {
                    throw new Exception("System is not able to update.", 1);
                } 
                else 
                {
                    $message->addMessage('Data is updated.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'salesman', null, true));
                }
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
        $id = Ccc::getModel('Salesman');
        $content = $this->getLayout()->getContent();
        $salesmanAdd = Ccc::getBlock('Salesman_Edit')->addData('salesman', $id);
        $content->addChild($salesmanAdd);
        $this->renderLayout();
    }

    public function editAction()
    {
        $message = $this->getMessage();
        try
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if (!$id)
            {
                throw new Exception("Edit is not working.", 1);
            }
            
            $id = Ccc::getModel('Salesman')->load($id);
            
            if (!$id) 
            {
                throw new Exception("This is not salesman Id.", 1);
            }
            $content = $this->getLayout()->getContent();
            $salesmanEdit = Ccc::getBlock('Salesman_Edit')->addData('salesman', $id);
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
            $message->addMessage('Successfully deleted salesman Id.', Model_Core_Message::SUCCESS);
            $this->redirect($this->getUrl('grid', 'salesman', null, true));
        }
    }
} 
?>
