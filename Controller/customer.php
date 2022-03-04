<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $customerGrid = Ccc::getBlock("Customer_Grid");
        $content->addChild($customerGrid);
        $this->renderLayout();
        //Ccc::getBlock("Customer_Grid")->toHtml();
    }

    protected function saveCustomer()
    {
        $customer = Ccc::getModel('Customer');
        $getSaveData = $this->getRequest()->getRequest('customer');
        $date = date('Y-m-d H:i:s');
        if(array_key_exists('id',$getSaveData) && $getSaveData['id'] == null)
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
                $customer->load($getSaveData['id']);
                $customer->id = $getSaveData['id'];
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
        $getSaveData = $this->getRequest()->getRequest('address');
        $address = Ccc::getModel('Customer_Address');
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

        $addressData = $address->fetchRow("SELECT * FROM address WHERE customerId = '$customerId'");


        if (!$addressData):
            $E = $address->customerId = $customerId;
            /*var_dump($E);
            die;*/
            $address->address = $getSaveData['address'];
            $address->city = $getSaveData['city'];
            $address->state = $getSaveData['state'];
            $address->country = $getSaveData['country'];
            $address->postalCode = $getSaveData['postalCode'];
            $address->billing = $getSaveData['billing'];
            $address->shipping = $getSaveData['shipping'];
            $result = $address->save();

        else:
            $address->load($getSaveData['id']);
            $address->customerId = $customerId;
            $address->addressId = $getSaveData['id'];
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
        $customer = Ccc::getModel("Customer");
        $content = $this->getLayout()->getContent();
        $customerAdd = Ccc::getBlock("Customer_Edit")->addData("customer", $id);
        $content->addChild($customerAdd);
        $this->renderLayout();
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
            $customer = Ccc::getModel("Customer")->load($id);
            $customer = $customer->fetchRow("select c.*,a.* from customer c join address a on a.customerId = c.id WHERE c.id = $id");

            if (!$customer) {
                throw new Exception("Error Processing Request", 1);
            }
            $content = $this->getLayout()->getContent();
            $customerEdit = Ccc::getBlock("Customer_Edit")->addData("customer", $id);
            $content->addChild($customerEdit);
            $this->renderLayout();
            //Ccc::getBlock("Customer_Edit")->addData("customer", $customer)->toHtml();
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest("id");
        $address = Ccc::getModel("Customer_Address")->load($getDelete);
        $customer = Ccc::getModel("Customer")->load($getDelete);
        $result = $customer->delete();
        if ($result) {
            $this->redirect($this->getUrl("grid", "customer", null, true));
        }
    }
    
    public function errorAction()
    {
        echo "error";
    }
} ?>
