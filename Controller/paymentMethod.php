<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>

<?php
class Controller_PaymentMethod extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $paymentMethodGrid = Ccc::getBlock("PaymentMethod_Grid");
        $content->addChild($paymentMethodGrid);
        $this->renderLayout();         
    }

    public function editAction()
    {
        $message = $this->getMessage();
        try 
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id){
               throw new Exception("Id not valid.");
            }
            $paymentMethod = Ccc::getModel('PaymentMethod')->load($id);
            if(!$paymentMethod){
                throw new Exception("unable to load paymentMethod.");
            }
            $content = $this->getLayout()->getContent();
            $paymentMethodEdit = Ccc::getBlock("PaymentMethod_Edit")->setData(["paymentMethod" => $paymentMethod]);
            $content->addChild($paymentMethodEdit);
            $this->renderLayout();        
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);     
            $this->redirect($this->getLayout()->getUrl('grid',null,null,true));
        }
    }

    public function addAction()
    {
        $paymentMethod = Ccc::getModel('PaymentMethod');
        $content = $this->getLayout()->getContent();
        $paymentMethodAdd = Ccc::getBlock('PaymentMethod_Edit')->setData(["paymentMethod" => $paymentMethod]);
        $content->addChild($paymentMethodAdd);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $message = $this->getMessage();
        try
        {
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $row = $this->getRequest()->getPost('paymentMethod');
            if (!$row) 
            {
                throw new Exception("Invalid Request.");             
            } 

            $methodId = (int)$this->getRequest()->getRequest('id');
            $paymentMethod = Ccc::getModel('PaymentMethod')->load($methodId);
            if(!$paymentMethod)
            {  
                $paymentMethod = Ccc::getModel('PaymentMethod');
                $paymentMethod->setData($row);
                $paymentMethod->createdAt = $date;
            }
            else
            {
                $paymentMethod->setData($row);
                $paymentMethod->updatedAt = $date;
            }
            $result = $paymentMethod->save();

            if (!$result)
            {
                throw new Exception("System is unable to update information.");
            }
            $message->addMessage('Data Saved Successfully'); 
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
        }
    }

    public function deleteAction()
    {
        $message = $this->getMessage();
        $getId = $this->getRequest()->getRequest('id');
        $paymentMethod = Ccc::getModel('PaymentMethod')->load($getId);
        try
        {
            if (!$getId)
            {
                throw new Exception("Invalid Request.");
            }
            $id = $getId;
            $result = $paymentMethod->delete(); 
            if (!$result)
            {
                throw new Exception("System is unable to delete record.");
            }
            $message->addMessage('Data Deleted Successfully');
           $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}


