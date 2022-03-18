<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php
class Controller_Vendor extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Vendor Grid');
        $content = $this->getLayout()->getContent();
        $vendorGrid = Ccc::getBlock('Vendor_Grid');
        $content->addChild($vendorGrid);
        $this->renderLayout();
    }

    protected function saveVendor()
    {
        $vendor = Ccc::getModel('Vendor');
        $getSaveData = $this->getRequest()->getRequest('vendor');
        $date = date('Y-m-d H:i:s');
        $message = $this->getMessage();

        if (!$getSaveData)
        {
            throw new Exception("You can not insert data in vendor ID.");
        }

        $vendorId = (int)$this->getRequest()->getRequest('id');
        $vendor = Ccc::getModel('Vendor')->load($vendorId);

        if(!$vendor)
        {
            $vendor = Ccc::getModel('Vendor');
            $vendor->setData($getSaveData);
            $vendor->createdAt = $date;
        }
        else
        {
            $vendor->setData($getSaveData);
            $vendor->updatedAt = $date;
        }
        $result = $vendor->save();
        return $result->vendorId;

        if (!$result) 
        {
            throw new Exception("You can not update data in vendor.");
        } 
        else 
        {
            $message->addMessage('Saved Successfully.');
            $this->redirect($this->getLayout()->getUrl('grid', 'vendor', null, false));
        }
    }
    
    protected function saveAddress($vendorId)
    {
        $getSaveData = $this->getRequest()->getRequest('address');
        $address = Ccc::getModel('Vendor_Address');
        $date = date('Y-m-d H:i:s');
        $message = $this->getMessage(); 

        $vendorModel = Ccc::getModel('Vendor')->load($vendorId);
        $addressData = $vendorModel->getVendorAddress();
        //$addressData = $address->fetchRow("SELECT * FROM vendor_address WHERE vendorId = '$vendorId'");

        if (!$getSaveData)
        {
            throw new Exception("You can not insert data in vendor ID.");
        }

        $addressId = (int)$this->getRequest()->getRequest('id');
        $address = Ccc::getModel('Vendor_Address')->load($addressId);

        if(!$address)
        {
            $address = Ccc::getModel('Vendor_Address');
            $address->setData($getSaveData);
            $address->vendorId = $vendorId;
        }
        else
        {
            $address->setData($getSaveData);
            $address->vendorId = $vendorId;
            $address->vendorAddressId = $getSaveData['vendorAddressId'];
        }
        $result = $address->save();

        if (!$result) 
        {
            throw new Exception("You can not update data in vendor.");
        } 
        else 
        {
            $message->addMessage('Data Saved.');
            $this->redirect($this->getLayout()->getUrl('grid', 'vendor', null, false));
        }
    }
    
    public function saveAction()
    {
        $message = $this->getMessage();
        try 
        {
            $vendorId = $this->saveVendor();
            $this->saveAddress($vendorId);
            $this->redirect($this->getLayout()->getUrl('grid', 'vendor', ['id' => null], false));
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'vendor', ['id' => null], false));
        }
    }

    public function addAction()
    {
        $this->setTitle('Vendor Add');
        $vendorModel = Ccc::getModel('vendor');
        $content = $this->getLayout()->getContent();
        $vendorAddress = $vendorModel->getVendorAddress();
        $vendorAdd = Ccc::getBlock("Vendor_Edit")->setData(['vendor' => $vendorModel , 'vendorAddress' => $vendorAddress]);
        $content->addChild($vendorAdd);
        $this->renderLayout();
    }
    
    public function editAction()
    {
        $this->setTitle('Vendor Edit');
        $message = $this->getMessage();
        try 
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if (!$id) 
            {
                throw new Exception('Error Processing Request');
            }

            $vendorModel = Ccc::getModel('Vendor')->load($id);
            $vendor = $vendorModel->fetchRow("SELECT * FROM `vendor` WHERE vendorId = '$id'");
            $vendorAddress = $vendorModel->getVendorAddress();

            //$vendorRow = Ccc::getModel('Vendor');
            //$vendor = $vendorRow->fetchRow("SELECT v.*,a.* from vendor v join vendor_address a on a.vendorId = v.vendorId WHERE v.vendorId = $id");

            if (!$vendor) 
            {
                throw new Exception('Error Processing Request');
            }
            $content = $this->getLayout()->getContent();
            $vendorEdit = Ccc::getBlock("Vendor_Edit")->setData(['vendor' => $vendor , 'vendorAddress' => $vendorAddress]);
            $content->addChild($vendorEdit);
            $this->renderLayout();
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'vendor', null, true));
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest('id');
        $address = Ccc::getModel('Vendor_Address')->load($getDelete);
        $vendor = Ccc::getModel('Vendor')->load($getDelete);
        $message = $this->getMessage();
        $result = $vendor->delete();
        if ($result) 
        {   
            $message->addMessage('Deleted Successfully.');
            $this->redirect($this->getLayout()->getUrl('grid', 'vendor', null, false));
        }
    }
} ?>
