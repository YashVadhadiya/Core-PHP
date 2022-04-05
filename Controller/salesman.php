<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php
class Controller_Salesman extends Controller_Core_Action
{


    public function indexAction()
    {
        $content = $this->getLayout()->getContent();
        $salesmanGrid = Ccc::getBlock('Salesman_Index');
        $content->addChild($salesmanGrid);
        $this->renderLayout();
    }

    public function gridBlockAction()
    {
     $salesmanGrid = Ccc::getBlock("Salesman_Grid")->toHtml();
     $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
     $response = [
        'status' => 'success',
        'content' => $salesmanGrid,
        'message' => $messageBlock,
    ] ;
    $this->renderJson($response);
}

public function addBlockAction()
{
    $salesman = Ccc::getModel('salesman');
    Ccc::register('salesman',$salesman);
    $customer = $salesman->getCustomers();
    Ccc::register('customer',$customer);
    $salesmanAdd =$this->getLayout()->getBlock('Salesman_Edit')->toHtml();
    $response = [
        'status' => 'success',
        'content' => $salesmanAdd
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
    $salesmanModel = Ccc::getModel('salesman')->load($id);
    $salesman = $salesmanModel->fetchRow("SELECT * FROM `salesman` WHERE `salesmanId` = $id");
    Ccc::register('salesman',$salesman);
    $customer = $salesmanModel->getCustomers();
    Ccc::register('customer',$customer);
    
    if(!$salesman)
    {
        throw new Exception("unable to load salesman.");
    }
    $content = $this->getLayout()->getContent();
    $salesmanEdit = Ccc::getBlock("Salesman_Edit")->toHtml();
    $response = [
        'status' => 'success',
        'content' => $salesmanEdit
    ];
    $this->renderJson($response);
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
            $this->redirect($this->getLayout()->getUrl('addBlock',null,['id' => $result->salesmanId , 'tab' => 'customer'],true));
        }
    }
    catch (Exception $e) 
    {
        $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
        $this->redirect($this->getLayout()->getUrl('gridBlock', 'salesman', ['id' => null], false));        
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
        $this->redirect($this->getLayout()->getUrl('gridBlock', 'salesman', null, false));
    }
}
} 
?>
