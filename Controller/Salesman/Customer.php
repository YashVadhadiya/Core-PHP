<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>

<?php

class Controller_Salesman_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle("Customer Grid");
        $content = $this->getLayout()->getContent();
        $salesmanCustomerGrid = Ccc::getBlock('Salesman_Customer_Grid');
        $content->addChild($salesmanCustomerGrid);
        $this->renderLayout();
    }

    public function indexAction()
    {
        $content = $this->getLayout()->getContent();

        $salesmanCustomerGrid = Ccc::getBlock('Salesman_Customer_Index');
        $content->addChild($salesmanCustomerGrid);

        $this->renderLayout();
    }

    public function gridBlockAction()
    {
       $salesmanCustomerGrid = Ccc::getBlock('Salesman_Customer_Grid')->toHtml();
       $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
       $response = [
        'status' => 'success',
        'content' => $salesmanCustomerGrid,
        'message' => $messageBlock,
    ] ;
    $this->renderJson($response);

}

public function addBlockAction()
{
    $salesmanCustomer = Ccc::getModel('Salesman_Customer');
    Ccc::register('salesmanCustomer',$salesmanCustomer);
    $salesmanCustomerAdd = $this->getLayout()->getBlock('Salesman_Customer_Edit')->toHtml();

    $response = [
        'status' => 'success',
        'content' => $salesmanCustomerAdd
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
    $salesmanCustomerModel = Ccc::getModel('salesmanCustomer')->load($id);
    $salesmanCustomer = $salesmanCustomerModel->fetchRow("SELECT * FROM `customer_price` WHERE `customerId` = $id");


    if(!$salesmanCustomer)
    {
        throw new Exception("unable to load salesman Customer.");
    }
    $content = $this->getLayout()->getContent();
    Ccc::register('salesmanCustomer', $salesmanCustomer);

    $salesmanCustomerEdit = Ccc::getBlock('Salesman_Customer_Edit')->toHtml();
    $response = [
        'status' => 'success',
        'content' => $salesmanCustomerEdit
    ] ;
    $this->renderJson($response);
    
}

public function saveAction() 

{
    try {
        $message = $this->getMessage();
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
        $message = $this->getMessage();
        $customer = Ccc::getModel('Customer');
        $row =  $this->getRequest()->getRequest('salesmanCustomer');

        if (!$row) 
        {
            throw new Exception("Invalid Request.");             
        }

        $customerIds = $row["customerNo"];

        $result = $customer->selectedCustomerData($customerIds);

        if(!$result)
        {
            throw new Exception("Update Unsuccessfully");   
        }
        $message->addMessage('Update Successfully.');
        $this->redirect($this->getLayout()->getUrl('gridBlock',null,null,false));
    } 
    catch (Exception $e) 
    {
        $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
        $this->redirect($this->getLayout()->getUrl('gridBlock',null,null,false));  
    }
}
}