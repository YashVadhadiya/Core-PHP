<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>

<?php
class Controller_Salesman_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Salesman Customer Grid');
        $content = $this->getLayout()->getContent();
        $salesmanCustomerGrid = Ccc::getBlock('Salesman_Customer_Grid');
        $content->addChild($salesmanCustomerGrid);
        $this->renderLayout();
    }

    public function saveAction()
    {
        try
        {
            $message = $this->getMessage();
            $getSaveData = $this->getRequest()->getRequest('salesmanCustomer');
            $customer = Ccc::getModel('Customer');
            $customerIds = $getSaveData['customerWithoutSalesman']; 
            $result = $customer->selectedCustomerData($customerIds);

            if(!$result)
            {
                throw new Exception("Error Processing Request");
            }
            $message->addMessage('Customer Added Succesfully');
            $this->redirect($this->getLayout()->getUrl('grid', 'salesman_customer', null, false));
            
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'salesman_customer', null, true));
        }
    }
}