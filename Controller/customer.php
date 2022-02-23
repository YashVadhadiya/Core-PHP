<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock("Customer_Grid")->toHtml();
    }

    protected function saveCustomer()
    {
        $customerModel = Ccc::getModel('Customer_Resource');
        $customer = $customerModel->getRow();
        $getSaveData = $this->getRequest()->getRequest('customer');
        $date = date('Y-m-d H:i:s');
        if(!array_key_exists('id',$getSaveData))
        {
                $customer->firstName = $getSaveData['firstName'];
                $customer->lastName = $getSaveData['lastName'];
                $customer->email = $getSaveData['email'];
                $customer->phone = $getSaveData['phone'];
                $customer->status = $getSaveData['status'];
                $result = $customer->save();
                return $result;
        }
        else
        {
                $customer = $customerModel->load($getSaveData['id']);
                $customer->firstName = $getSaveData['firstName'];
                $customer->lastName = $getSaveData['lastName'];
                $customer->email = $getSaveData['email'];
                $customer->phone = $getSaveData['phone'];
                $customer->status = $getSaveData['status'];
                $customer->updatedAt = $date;
                $result = $customer->save();
                return $getSaveData['id'];
        }
    }
    
    protected function saveAddress($customerId)
    {
        $addressModel = Ccc::getModel('Customer_Address_Resource');
        $address = $addressModel->getRow();
        date_default_timezone_set("Asia/Kolkata");
        $getSaveData = $this->getRequest()->getRequest('address');
        $date = date('Y-m-d H:i:s');
        
        $billing = 0;
        $shipping = 0;
        if (array_key_exists("billing", $getSaveData) && $getSaveData["billing"] == 1) 
        {
            $billing = 1;
        }
        if (array_key_exists("shipping", $getSaveData) && $getSaveData["shipping"] == 1) 
        {
            $shipping = 1;
        }

        $addressData = $addressModel->fetchRow("SELECT * FROM address WHERE customerId = '$customerId'");


        if (!$addressData):
            
            $address->customerId = $customerId;
            $address->address = $getSaveData['address'];
            $address->city = $getSaveData['city'];
            $address->state = $getSaveData['state'];
            $address->country = $getSaveData['country'];
            $address->postalCode = $getSaveData['postalCode'];
            $address->billing = $getSaveData['billing'];
            $address->shipping = $getSaveData['shipping'];
            $result = $address->save();

            if (!$result):
                throw new Exception("System is unable to insert address info.",1);
            endif;
        else:

            $address = $addressModel->load($getSaveData['id']);
            $address->customerId = $customerId;
            $address->address = $getSaveData['address'];
            $address->city = $getSaveData['city'];
            $address->state = $getSaveData['state'];
            $address->country = $getSaveData['country'];
            $address->postalCode = $getSaveData['postalCode'];
            $address->billing = $getSaveData['billing'];
            $address->shipping = $getSaveData['shipping'];
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
            $customerId = $this->saveCustomer();
            $this->saveAddress($customerId);
            $this->redirect($this->getUrl("grid", "customer", null, true));
        }
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        Ccc::getBlock("Customer_Add")->toHtml();
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
            $customerModel = Ccc::getModel("Customer_Resource");
            $customer = $customerModel->fetchRow("SELECT c.*, a.* from customer c left join address a on c.id = a.customerId WHERE c.id = $id");
            
            if (!$customer) {
                throw new Exception("Error Processing Request", 1);
            }
            
            Ccc::getBlock("Customer_Edit")->addData("customer", $customer)->toHtml();
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        $addressModel = Ccc::getModel("Customer_Address_Resource");
        $customerModel = Ccc::getModel("Customer_Resource");
        $getUpdateData = $this->getRequest()->getRequest("id");
        $id = $getUpdateData;
        $result = $customerModel->delete(["id" => $id]);
        if ($result) {
            $this->redirect($this->getUrl("grid", "customer", null, true));
        }
    }
    
    public function errorAction()
    {
        echo "error";
    }
} ?>
