<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>

<?php
class Controller_ShippingMethod extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $shippingMethodGrid = Ccc::getBlock("ShippingMethod_Grid");
        $content->addChild($shippingMethodGrid);
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
            $shippingMethod = Ccc::getModel('ShippingMethod')->load($id);
            if(!$shippingMethod){
                throw new Exception("unable to load shippingMethod.");
            }
            $content = $this->getLayout()->getContent();
            $shippingMethodEdit = Ccc::getBlock("ShippingMethod_Edit")->setData(["shippingMethod" => $shippingMethod]);
            $content->addChild($shippingMethodEdit);
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
        $shippingMethod = Ccc::getModel('ShippingMethod');
        $content = $this->getLayout()->getContent();
        $shippingMethodAdd = Ccc::getBlock('ShippingMethod_Edit')->setData(["shippingMethod" => $shippingMethod]);
        $content->addChild($shippingMethodAdd);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $message = $this->getMessage();
        try
        {
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $row = $this->getRequest()->getPost('shippingMethod');
            if (!$row) 
            {
                throw new Exception("Invalid Request.");             
            } 

            $methodId = (int)$this->getRequest()->getRequest('id');
            $shippingMethod = Ccc::getModel('ShippingMethod')->load($methodId);
            if(!$shippingMethod)
            {  
                $shippingMethod = Ccc::getModel('ShippingMethod');
                $shippingMethod->setData($row);
                $shippingMethod->createdAt = $date;
            }
            else
            {
                $shippingMethod->setData($row);
                $shippingMethod->updatedAt = $date;
            }
            $result = $shippingMethod->save();

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
        $shippingMethod = Ccc::getModel('ShippingMethod')->load($getId);
        try
        {
            if (!$getId)
            {
                throw new Exception("Invalid Request.");
            }
            $id = $getId;
            $result = $shippingMethod->delete(); 
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


