<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php
class Controller_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Customer Grid');
        $content = $this->getLayout()->getContent();
        $customerGrid = Ccc::getBlock('Customer_Grid');
        $content->addChild($customerGrid);
        $this->renderLayout();
    }

    protected function saveCustomer()
    {
        $customer = Ccc::getModel('Customer');
        $getSaveData = $this->getRequest()->getRequest('customer');
        $date = date('Y-m-d H:i:s');
        $message = $this->getMessage();

        if (!$getSaveData)
        {
            throw new Exception("You can not insert data in customer ID.");
        }

        $customerId = (int)$this->getRequest()->getRequest('id');
        $customer = Ccc::getModel('Customer')->load($customerId);

        if(!$customer)
        {
            $customer = Ccc::getModel('Customer');
            $customer->setData($getSaveData);
            $customer->createdAt = $date;
        }
        else
        {
            $customer->setData($getSaveData);
            $customer->updatedAt = $date;
        }
        $result = $customer->save();
        return $result->id;

        if (!$result) 
        {
            throw new Exception("You can not update data in customer.");
        } 
        else 
        {
            $message->addMessage('Updated Successfully.');
            $this->redirect($this->getUrl('grid', 'customer', null, false));
        }
    }
    
    /*protected function saveAddress($customerId)
    {
        $getSaveData = $this->getRequest()->getRequest('address');
        $address = Ccc::getModel('Customer_Address');
        $date = date('Y-m-d H:i:s');
        $message = $this->getMessage();

        $billingRow = $this->getRequest()->getRequest('billingaddress');
        $shippingRow = $this->getRequest()->getRequest('shippingaddress');

        $customerModel = Ccc::getModel('customer')->load($customerId);
        $billingAddress = $customerModel->getBillingAddress();
        //$shippingAddress = $customerModel->getShippingAddress();
        //$addressData = $address->fetchRow("SELECT * FROM address WHERE customerId = '$customerId'");

        if($billingAddress != null)
        {
            $address = Ccc::getModel('Customer_Address');
            $address->setData($billingRow);
            $address->customerId = $customerId;
            $address->billing =  1;
            $address->shipping =  0;
            $result = $address->save();
            
            if(!$result)
            {
                throw new Exception("Not Saved.");
            }
            $message->addMessage('Saved Successfully.');
        }
        else
        {
            $address->setData($billingRow);
            $result = $address->save();
            if(!$result)
            {
                throw new Exception("Not Saved.");
            }
            $message->addMessage('Saved Successfully.');
        }

         if($billingAddress != null)
        {
            $address = Ccc::getModel('Customer_Address');
            $address->setData($shippingRow);
            $address->customerId = $customerId;
            $address->billing =  0;
            $address->shipping =  1;
            $result = $address->save();
            
            if(!$result)
            {
                throw new Exception("Not Saved.");
            }
            $message->addMessage('Saved Successfully.');
        }
        else
        {
            $address->setData($shippingRow);
            $result = $address->save();
            
            if(!$result)
            {
                throw new Exception("Not Saved.");
            }
            $message->addMessage('Saved Successfully.');
        }
    }*/

    protected function saveAddress($customerId) 
    {
        $message = $this->getMessage();
        $address = Ccc::getModel('Customer_Address');
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d H:i:s');
        $billingRow = $this->getRequest()->getPost('billingAddress');
        $shippingRow = (array_key_exists('sameShipping', $this->getRequest()->getPost())) ? $billingRow : $this->getRequest()->getPost('shippingAddress'); 
        $customerModel = Ccc::getModel('customer')->load($customerId);
        $billingAddress = $customerModel->getBillingAddress();
        $shippingAddress = $customerModel->getShippingAddress();

        if(!$billingAddress->getData())
        {   
            $billingAddress->customerId = $customerId;

        }
        if(!$shippingAddress->getData())
        {
            $shippingAddress->customerId = $customerId;
        }
        $billingAddress->setData($billingRow);
        $billingAddress->billing = 1;
        $billingAddress->shipping = 0;
        $billingAddress->same = (array_key_exists('sameShipping', $this->getRequest()->getPost())) ? 1 : 0;

        $shippingAddress->setData($shippingRow);
        $shippingAddress->billing = 0;
        $shippingAddress->shipping = 1;
        $shippingAddress->same = (array_key_exists('sameShipping', $this->getRequest()->getPost())) ? 1 : 0;

        $billingAddress->save();
        $shippingAddress->save();

        $message->addMessage('Customer & Address Added successfully.');

    }
    
    public function saveAction()
    {
        $message = $this->getMessage();
        try 
        {
            $customerId = $this->saveCustomer();
            $this->saveAddress($customerId);
            $this->redirect($this->getUrl('grid', 'customer', ['id' => null], false));
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'customer', ['id' => null], false));
        }
    }

    public function addAction()
    {
        $this->setTitle('Customer Add');
        $id = Ccc::getModel('Customer');
        $content = $this->getLayout()->getContent();
        $billingAddress = Ccc::getModel('Customer_Address');
        $shippingAddress = Ccc::getModel('Customer_Address');
        $customerAdd = Ccc::getBlock('Customer_Edit')->setData(['customer' => $id, 'billingAddress' => $billingAddress, 'shippingAddress' => $shippingAddress]);
        $content->addChild($customerAdd);
        $this->renderLayout();
    }
    
    public function editAction()
    {
        $this->setTitle('Customer Edit');
        $message = $this->getMessage();
        try 
        {
            $id = (int) $this->getRequest()->getRequest('id');
            if (!$id) 
            {
                throw new Exception('Error Processing Request');
            }

            $customerModel = Ccc::getModel('Customer')->load($id);
            $customer = $customerModel->fetchRow("SELECT * FROM `customer` WHERE id = '$id'");
            $billingAddress = $customerModel->getBillingAddress();
            $shippingAddress = $customerModel->getShippingAddress();

            /*$customerRow = Ccc::getModel('Customer');
            $billingAddress = $address->fetchRow("SELECT * FROM address WHERE customerId = {$id} AND billing =1; ");
            $shippingAddress = $address->fetchRow("SELECT * FROM address WHERE customerId = {$id} AND shipping =1; ");
            $address = Ccc::getModel('Customer_Address');
            $customer = $customerRow->fetchRow("SELECT c.*,a.* from customer c join address a on a.customerId = c.id WHERE c.id = '$id'");*/

            if (!$customer) 
            {
                throw new Exception('Error Processing Request');
            }
            $content = $this->getLayout()->getContent();
            $customerEdit = Ccc::getBlock('Customer_Edit')->setData(['customer' => $customer, 'billingAddress' => $billingAddress , 'shippingAddress' => $shippingAddress]);
            $content->addChild($customerEdit);
            $this->renderLayout();
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'customer', null, true));
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest('id');
        $address = Ccc::getModel('Customer_Address')->load($getDelete);
        $customer = Ccc::getModel('Customer')->load($getDelete);
        $message = $this->getMessage();
        $result = $customer->delete();
        if ($result) 
        {   
            $message->addMessage('Deleted Successfully.');
            $this->redirect($this->getUrl('grid', 'customer', null, false));
        }
    }
} 

?>