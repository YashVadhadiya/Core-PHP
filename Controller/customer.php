<?php
Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Core_Request");

class Controller_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock("Customer_Grid")->toHtml();
    }

    protected function saveCustomer()
    {
        $customerModel = Ccc::getModel("Customer");
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d H:i:s");
        $getSaveData = $this->getRequest()->getRequest("customer");

        if (!array_key_exists("id", $getSaveData)) 
        {
            $customerModel = Ccc::getModel("Customer");
            $result = $customerModel->insert(["firstName" => $getSaveData["firstName"],"lastName" => $getSaveData["lastName"],"email" => $getSaveData["email"],"phone" => $getSaveData["phone"],"status" => $getSaveData["status"],]);

            if (!$result) 
            {
                throw new Exception("System is unable to insert customer info.",1);
            }
            return $result;
        }
        else 
        {
            $id = $getSaveData["id"];
            $result = $customerModel->update(["firstName" => $getSaveData["firstName"],"lastName" => $getSaveData["lastName"],"email" => $getSaveData["email"],"phone" => $getSaveData["phone"],"status" => $getSaveData["status"],"updatedAt" => $date,],["id" => $id]);
            
            if (!$result) 
            {
                throw new Exception("System is unable to update customer information.",1);
            }
            return $id;
        }
    }
    protected function saveAddress($customerId)
    {
        $addressModel = Ccc::getModel("Customer_Address");
        $getSaveData = $this->getRequest()->getRequest("address");
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
            $result = $addressModel->insert(["customerId" => $customerId,"address" => $getSaveData["address"],"postalCode" => $getSaveData["postalCode"],"city" => $getSaveData["city"],"state" => $getSaveData["state"],"country" => $getSaveData["country"],"billing" => $getSaveData["billing"],"shipping" => $getSaveData["shipping"],]);

            if (!$result):
                throw new Exception("System is unable to insert address info.",1);
            endif;
        else:
            $id = $getSaveData["id"];
            $result = $addressModel->update(["customerId" => $customerId,"address" => $getSaveData["address"],"city" => $getSaveData["city"],"state" => $getSaveData["state"],"country" => $getSaveData["country"],"postalCode" => $getSaveData["postalCode"],"billing" => $billing,"shipping" => $shipping],["addressId" => $id]);

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
            $customerModel = Ccc::getModel("Customer");
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
        $addressModel = Ccc::getModel("Customer_Address");
        $customerModel = Ccc::getModel("Customer");
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
