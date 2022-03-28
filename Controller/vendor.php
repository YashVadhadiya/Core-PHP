<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php Ccc::loadClass("Model_Core_Request"); ?>
<?php
class Controller_Vendor extends Controller_Core_Action
{ 
    
    public function gridAction()
    {
        $this->setTitle("Vendor Grid");
        $content = $this->getLayout()->getContent();
        $vendorGrid = Ccc::getBlock("Vendor_Grid");
        $content->addChild($vendorGrid);
        $this->renderLayout();
    }

    public function addAction()
    {
        $this->setTitle('Vendor Add');
        $vendorModel = Ccc::getModel('vendor');
        $content = $this->getLayout()->getContent();
        Ccc::register('vendor',$vendorModel);
        $vendorId = $this->getRequest()->getRequest('id');
        $vendorAddress = $vendorModel->getVendorAddress();    
        Ccc::register('vendorAddress',$vendorAddress);
        $vendorAdd = Ccc::getBlock("Vendor_Edit");
        $content->addChild($vendorAdd);
        $this->renderLayout();
    }

    public function editAction()
    {
         try 
        {
            $this->setTitle("Vendor Edit");
            $message = $this->getMessage();
            $id = (int) $this->getRequest()->getRequest('id');
            if(!$id)
            {
                throw new Exception("Id not valid.");
            }
            $vendorModel = Ccc::getModel('Vendor')->load($id);
            if(!$vendorModel)
            {
                throw new Exception("Unable To Load Admin.");
            }
            $vendor = $vendorModel->fetchRow("SELECT * FROM `vendor` WHERE vendorID = '$id'");
    
            $vendorAddress = $vendorModel->getVendorAddress();
            
            if(!$vendor)
            {
                throw new Exception("unable to load vendor.");
            }
            $content = $this->getLayout()->getContent();
            Ccc::register('vendor',$vendor);
            Ccc::register('vendorAddress',$vendorAddress);
            $vendorEdit = Ccc::getBlock("Vendor_Edit");
            $content->addChild($vendorEdit);
            $this->renderLayout();            
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid',null,null,true));  
        }
    }

    protected function saveVendor()
    {
        $message = $this->getMessage();
        $date = date("Y-m-d H:i:s");
        try
        {
            $getSaveData = $this->getRequest()->getPost('vendor');
            $vendorId = (int)$this->getRequest()->getRequest('id');
            if (!$getSaveData) 
            {
                return;           
            } 
    
            $vendor = Ccc::getModel('Vendor')->load($vendorId);

            if(!$vendor)
            {
                $vendor = Ccc::getModel('Vendor');
                $vendor->setData($getSaveData);
                $vendor->createdAt = $date;
                $result = $vendor->save();
            }
            else
            {
                $vendor->setData($getSaveData);     
                $vendor->updatedAt = $date;
                $result = $vendor->save();
            }

            if (!$result)
            {
                throw new Exception("Update Unsuccessfully");
            }
            $message->addMessage('Update Successfully'); 
            $this->redirect($this->getLayout()->getUrl('edit','vendor',['id' => $result->vendorId , 'tab' => address],true));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getLayout()->getUrl('grid','vendor',null,true));
        }
    }
      
    protected function saveAddress()
    {
        $vendorId = $this->getRequest()->getRequest('id');
        $vendor = Ccc::getModel('vendor')->load($vendorId);
        $address = $vendor->getVendorAddress();
        $vandorAddressId = $address->vendorAddressId;
        Ccc::register('address',$address);
        $address = Ccc::getModel('Vendor_Address'); 
        try 
        {
            $message = $this->getMessage();
           $getSaveData = $this->getRequest()->getPost('address');
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
        
        $vendorModel = Ccc::getModel('Vendor')->load($vendorId);
        $addressData = $vendorModel->getVendorAddress();
        if(!$addressData->vendorAddressId)
        {
            $address = Ccc::getModel('Vendor_Address');
            $address->setData($getSaveData);
            $address->vendorId = $vendorId;
            $result = $address->save();
            
            if(!$result)
            {
                throw new Exception("Insert Unsuccessfully.");
            }
            $message->addMessage('Insert Successfully.');
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false)); 
        }
        else
        {
            $address->setData($getSaveData);
            $result = $address->save();

            if(!$result)
            {
                throw new Exception("Update Unsuccessfully.");
            }
            $message->addMessage('Update Successfully.');
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false)); 
        }
           
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid',null,null,true));  
        }
    }

    public function saveAction()
    {      
        try 
        {
            $vendorId = $this->saveVendor();
            $this->saveAddress();
            $this->redirect($this->getLayout()->getUrl('grid','vendor',null,true));
        } 
        catch (Exception $e) 
        {
            $this->redirect($this->getLayout()->getUrl('grid','vendor',null,true));
        }
    }

    public function deleteAction()
    {
        $message = $this->getMessage();
        $getId = $this->getRequest()->getRequest('id');
        $vendorTable = Ccc::getModel('Vendor')->load($getId); 
        try 
        {
            if (!$getId) 
            {
                throw new Exception("Invalid Request.");
            }
            $delete = $vendorTable->delete(['vendorId' => $getId]);
            if (!$delete) 
            {
                throw new Exception("System is unable to delete record.");
            }
            $message->addMessage('Delete Successfully.');       
            $this->redirect($this->getLayout()->getUrl('grid','vendor',['id' => null],false));
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid',null,['id' => null],false));  
        }
    }
}