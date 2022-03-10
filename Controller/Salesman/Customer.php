<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Salesman_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $salesmanCustomerGrid = Ccc::getBlock('Salesman_Customer_Grid');
        $content->addChild($salesmanCustomerGrid);
        $this->renderLayout();
    }

    public function saveAction()
    {
        try
        {
            $message = Ccc::getModel('Core_Message');
            $getSaveData = $this->getRequest()->getRequest('salesmanCustomer');
            $customer = Ccc::getModel('Customer');
            $customerIds = $getSaveData['customerWithoutSalesman']; 
            $result = $customer->selectedCustomerData($customerIds);

            if(!$result)
            {
                throw new Exception("Error Processing Request", 1);
            }
            $message->addMessage('Customer Added Succesfully');
            $this->redirect($this->getUrl('grid', 'salesman_customer', null, false));
            
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'salesman_customer', null, true));
        }
    }
}