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
        $message = Ccc::getModel('Core_Message');
    
        try
        {
            if (!isset($getSaveData)) 
            {
                $message->addMessage('You can not insert data in salesman ID.', Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid', 'salesman', null, true));
            }

            if(array_key_exists('salesmanId', $getSaveData) && $getSaveData['salesmanId'] == null)
            {
                $salesman->firstName = $getSaveData['firstName'];
                $salesman->lastName = $getSaveData['lastName'];
                $salesman->email = $getSaveData['email'];
                $salesman->phone = $getSaveData['phone'];
                $salesman->status = $getSaveData['status'];
                $result = $salesman->save();

                if (!$result) 
                {
                    $message->addMessage('System is not able to insert.', Model_Core_Message::ERROR);
                    $this->redirect($this->getUrl('grid', 'salesman', null, true));
                } 
                else 
                {
                    $message->addMessage('Data is inserted.', Model_Core_Message::ERROR);
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
                $salesman->updatedAt = $date;
                $result = $salesman->save();

                if (!$result) 
                {
                    $message->addMessage('System is not able to update.', Model_Core_Message::ERROR);
                    $this->redirect($this->getUrl('grid', 'salesman', null, true));
                } 
                else 
                {
                    $message->addMessage('Data is updated.', Model_Core_Message::ERROR);
                    $this->redirect($this->getUrl('grid', 'salesman', null, true));
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
        $id = Ccc::getModel('Salesman');
        $content = $this->getLayout()->getContent();
        $salesmanAdd = Ccc::getBlock('Salesman_Edit')->addData('salesman', $id);
        $content->addChild($salesmanAdd);
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
                $message->addMessage('Edit is not working.', Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid', 'salesman', null, true));
            }
            
            $id = Ccc::getModel('Salesman')->load($id);
            
            if (!$id) 
            {
                $message->addMessage('This is not salesman Id.', Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid', 'salesman', null, true));
            }
            $content = $this->getLayout()->getContent();
            $salesmanEdit = Ccc::getBlock('Salesman_Edit')->addData('salesman', $id);
            $content->addChild($salesmanEdit);
            $this->renderLayout();
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest('id');
        $salesman = Ccc::getModel('Salesman')->load($getDelete);
        $message = Ccc::getModel('Core_Message');
        $result = $salesman->delete();
    
        if ($result)
        {
            $message->addMessage('Successfully deleted salesman Id.', Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'salesman', null, true));
        }
    }
    public function errorAction()
    {
        echo 'error';
    }
} 
?>
