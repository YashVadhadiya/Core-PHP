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


        if(array_key_exists('id',$getSaveData) && $getSaveData['id'] == null)
        {
            $customer->firstName = $getSaveData['firstName'];
            $customer->lastName = $getSaveData['lastName'];
            $customer->email = $getSaveData['email'];
            $customer->phone = $getSaveData['phone'];
            $customer->status = $getSaveData['status'];
            $customer->createdAt = $date;
            $result = $customer->save();
            return $result;

            if (!$result) 
                {
                    throw new Exception("You can not insert data in customer.");
                } 
            else 
                {
                    $message->addMessage('Inserted Succesfully.');
                    $this->redirect($this->getUrl('grid', 'customer', null, true));
                }
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

            if (!$result) 
                {
                    throw new Exception("You can not insert data in customer.");
                } 
            else 
                {
                    $message->addMessage('Inserted Succesfully.');
                    $this->redirect($this->getUrl('grid', 'customer', null, true));
                }

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

            if (!$result) 
                {
                    throw new Exception("You can not update data in customer.");
                } 
            else 
                {
                    $message->addMessage('Updated Successfully.');
                    $this->redirect($this->getUrl('grid', 'customer', null, true));
                }
        endif;
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