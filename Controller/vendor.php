<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Vendor extends Controller_Core_Action
{
    public function gridAction()
    {
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
        $message = Ccc::getModel('Core_Message');

        if(array_key_exists('vendorId',$getSaveData) && $getSaveData['vendorId'] == null)
        {
                $vendor->firstName = $getSaveData['firstName'];
                $vendor->lastName = $getSaveData['lastName'];
                $vendor->email = $getSaveData['email'];
                $vendor->phone = $getSaveData['phone'];
                $vendor->status = $getSaveData['status'];
                $result = $vendor->save();
                return $result;

                if (!$result) 
                {
                    throw new Exception("You can not insert data in vendor.", 1);
                } 
            else 
                {
                    $message->addMessage('Data is inserted in vendor.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'vendor', null, true));
                }

        }
        else
        {
                $vendor->load($getSaveData['vendorId']);
                $vendor->vendorId = $getSaveData['vendorId'];
                $vendor->firstName = $getSaveData['firstName'];
                $vendor->lastName = $getSaveData['lastName'];
                $vendor->email = $getSaveData['email'];
                $vendor->phone = $getSaveData['phone'];
                $vendor->status = $getSaveData['status'];
                $vendor->updatedAt = $date;
                $result = $vendor->save();
                return $getSaveData['vendorId'];

                if (!$result) 
                {
                    throw new Exception("You can not update data in vendor.", 1);
                } 
            else 
                {
                    $message->addMessage('Data is updated in vendor.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'vendor', null, true));
                }
        }
    }
    
    protected function saveAddress($vendorId)
    {
        $getSaveData = $this->getRequest()->getRequest('address');
        $address = Ccc::getModel('Vendor_Address');
        $date = date('Y-m-d H:i:s');
        $message = Ccc::getModel('Core_Message');

        $addressData = $address->fetchRow("SELECT * FROM vendor_address WHERE vendorId = '$vendorId'");

        if (!$addressData):
            $address->vendorId = $vendorId;
            $address->address = $getSaveData['address'];
            $address->city = $getSaveData['city'];
            $address->state = $getSaveData['state'];
            $address->country = $getSaveData['country'];
            $address->postalCode = $getSaveData['postalCode'];
            $result = $address->save();

            if (!$result) 
                {
                    throw new Exception("You can not insert data in vendor.", 1);
                } 
            else 
                {
                    $message->addMessage('Data is inserted in vendor.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'vendor', null, true));
                }

        else:
            $address->load($getSaveData['vendorId']);
            $address->vendorId = $vendorId;
            $address->vendorAddressId = $getSaveData['vendorAddressId'];
            $address->address = $getSaveData['address'];
            $address->city = $getSaveData['city'];
            $address->state = $getSaveData['state'];
            $address->country = $getSaveData['country'];
            $address->postalCode = $getSaveData['postalCode'];
            $result = $address->save();

            if (!$result) 
                {
                    throw new Exception("You can not update data in vendor.", 1);
                } 
            else 
                {
                    $message->addMessage('Data is updated in vendor.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl('grid', 'vendor', null, true));
                }
        endif;
    }
    
    public function saveAction()
    {
        $message = Ccc::getModel('Core_Message');
        try 
        {
            $vendorId = $this->saveVendor();
            $this->saveAddress($vendorId);
            $this->redirect($this->getUrl('grid', 'vendor', null, true));
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'vendor', null, true));
        }
    }

    public function addAction()
    {
        $id = Ccc::getModel('Vendor');
        $content = $this->getLayout()->getContent();
        $vendorAdd = Ccc::getBlock('Vendor_Edit')->addData('vendor', $id);
        $content->addChild($vendorAdd);
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
                throw new Exception('Error Processing Request', 1);
            }
            $vendorRow = Ccc::getModel('Vendor');
            $vendor = $vendorRow->fetchRow("SELECT v.*,a.* from vendor v join vendor_address a on a.vendorId = v.vendorId WHERE v.vendorId = $id");

            if (!$vendor) 
            {
                throw new Exception('Error Processing Request', 1);
            }
            $content = $this->getLayout()->getContent();
            $vendorEdit = Ccc::getBlock('Vendor_Edit')->addData('vendor', $vendor);
            $content->addChild($vendorEdit);
            $this->renderLayout();
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'vendor', null, true));
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest('id');
        $address = Ccc::getModel('Vendor_Address')->load($getDelete);
        $vendor = Ccc::getModel('Vendor')->load($getDelete);
        $message = Ccc::getModel('Core_Message');
        $result = $vendor->delete();
        if ($result) 
        {   
            $message->addMessage('Data Deleted Succesfully.', Model_Core_Message::SUCCESS);
            $this->redirect($this->getUrl('grid', 'vendor', null, true));
        }
    }
    
    public function errorAction()
    {
        echo 'error';
    }
} ?>
