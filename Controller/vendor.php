<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Vendor extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock("Vendor_Grid")->toHtml();
    }

    protected function saveVendor()
    {
        $vendor = Ccc::getModel('Vendor');
        $getSaveData = $this->getRequest()->getRequest('vendor');
        $date = date('Y-m-d H:i:s');
        if(array_key_exists('vendorId',$getSaveData) && $getSaveData['vendorId'] == null)
        {
                $vendor->firstName = $getSaveData['firstName'];
                $vendor->lastName = $getSaveData['lastName'];
                $vendor->email = $getSaveData['email'];
                $vendor->phone = $getSaveData['phone'];
                $vendor->status = $getSaveData['status'];
                $result = $vendor->save();
                return $result;
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
        }
    }
    
    protected function saveAddress($vendorId)
    {
        $getSaveData = $this->getRequest()->getRequest('address');
        $address = Ccc::getModel('Vendor_Address');
        $date = date('Y-m-d H:i:s');

        $addressData = $address->fetchRow("SELECT * FROM vendor_address WHERE vendorId = '$vendorId'");


        if (!$addressData):
            $address->vendorId = $vendorId;
            $address->address = $getSaveData['address'];
            $address->city = $getSaveData['city'];
            $address->state = $getSaveData['state'];
            $address->country = $getSaveData['country'];
            $address->postalCode = $getSaveData['postalCode'];
            $result = $address->save();

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

            if (!$result):
                throw new Exception("System is unable to update address information.",1);
            endif;
        endif;
    }
    
    public function saveAction()
    {
        try 
        {
            $vendorId = $this->saveVendor();
            $this->saveAddress($vendorId);
            $this->redirect($this->getUrl("grid", "vendor", null, true));
        }
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        $vendor = Ccc::getModel("Vendor"); //->load($id);
        //Ccc::getBlock("vendor_Add")->toHtml();
        Ccc::getBlock("Vendor_Edit")->addData("vendor", $vendor)->toHtml();
    }
    
    public function editAction()
    {
        try 
        {
            $id = (int) $this->getRequest()->getRequest("id");
            if (!$id) 
            {
                throw new Exception("Error Processing Request", 1);
            }
            $vendor = Ccc::getModel("Vendor")->load($id);
            $vendor = $vendor->fetchRow("select v.*,a.* from vendor v join vendor_address a on a.vendorId = v.vendorId WHERE v.vendorId = $id");

            if (!$vendor) {
                throw new Exception("Error  Processing Request", 1);
            }
            
            Ccc::getBlock("Vendor_Edit")->addData("vendor", $vendor)->toHtml();
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest("id");
        $address = Ccc::getModel("Vendor_Address")->load($getDelete);
        $vendor = Ccc::getModel("Vendor")->load($getDelete);
        $result = $vendor->delete();
        if ($result) {
            $this->redirect($this->getUrl("grid", "vendor", null, true));
        }
    }
    
    public function errorAction()
    {
        echo "error";
    }
} ?>
