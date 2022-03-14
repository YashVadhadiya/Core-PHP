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
            throw new Exception("You can not insert data in vendor ID.");
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
            $this->redirect($this->getUrl('grid', 'customer', null, true));
        }
    }
    
    protected function saveAddress($customerId)
    {
        $getSaveData = $this->getRequest()->getRequest('address');
        $address = Ccc::getModel('Customer_Address');
        $date = date('Y-m-d H:i:s');
        $message = $this->getMessage();
        
        $billing = 0;
        $shipping = 0;
        if (array_key_exists('billing', $getSaveData) && $getSaveData['billing'] == 1) 
        {
            $billing = 1;
        }
        if (array_key_exists('shipping', $getSaveData) && $getSaveData['shipping'] == 1) 
        {
            $shipping = 1;
        }

        $addressData = $address->fetchRow("SELECT * FROM address WHERE customerId = '$customerId'");

        if (!$getSaveData)
        {
            throw new Exception("You can not insert data in vendor ID.");
        }

        $addressId = (int)$this->getRequest()->getRequest('id');
        $address = Ccc::getModel('Customer_Address')->load($addressId);

        if(!$address)
        {
            $address = Ccc::getModel('Customer_Address');
            $address->setData($getSaveData);
            $address->customerId = $customerId;
            $address->billing = $getSaveData['billing'];
            $address->shipping = $getSaveData['shipping'];
        }
        else
        {
            $address->setData($getSaveData);
            $address->customerId = $customerId;
            $address->addressId = $getSaveData['id'];
            $address->billing = $getSaveData['billing'];
            $address->shipping = $getSaveData['shipping'];
        }
        $result = $address->save();

            if (!$result) 
                {
                    throw new Exception("You can not update data in customer.");
                } 
            else 
                {
                    $message->addMessage('Data Saved.');
                    $this->redirect($this->getUrl('grid', 'customer', null, true));
                }
    }
    
    public function saveAction()
    {
        $message = $this->getMessage();
        try 
        {
            $customerId = $this->saveCustomer();
            $this->saveAddress($customerId);
            $this->redirect($this->getUrl('grid', 'customer', null, true));
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid', 'customer', null, true));
        }
    }

    public function addAction()
    {
        $this->setTitle('Customer Add');
        $id = Ccc::getModel('Customer');
        $content = $this->getLayout()->getContent();
        $customerAdd = Ccc::getBlock('Customer_Edit')->setData(['customer' => $id]);
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
            $customerRow = Ccc::getModel('Customer');
            $customer = $customerRow->fetchRow("SELECT c.*,a.* from customer c join address a on a.customerId = c.id WHERE c.id = '$id'");

            if (!$customer) 
            {
                throw new Exception('Error Processing Request');
            }
            $content = $this->getLayout()->getContent();
            $customerEdit = Ccc::getBlock('Customer_Edit')->setData(['customer' => $customer]);
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
            $this->redirect($this->getUrl('grid', 'customer', null, true));
        }
    }
} 

?>