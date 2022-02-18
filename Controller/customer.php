<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
?>
<?php
class Controller_Customer extends Controller_Core_Action
{
    public function testAction()
    {
        $adminTable = new Model_Admin();
    }

    public function gridAction()
    {
        Ccc::getBlock('Customer_Grid')->toHtml();       
    }

    protected function saveCustomer()
    {
        $request = new Model_Core_Request();
        $getSaveCustomerData = $request->getPost('customer');
        if (!isset($getSaveCustomerData['id']))
        {
            throw new Exception("Data is not inserted in customer(isset).", 1);
        }
        $adapter = new Model_Core_Adapter();
        $date = date('Y-m-d H:i:s');
        $id = $getSaveCustomerData['id'];
        $firstName = $getSaveCustomerData['firstName'];
        $lastName = $getSaveCustomerData['lastName'];
        $email = $getSaveCustomerData['email'];
        $phone = $getSaveCustomerData['phone'];
        $status = $getSaveCustomerData['status'];
        $createdAt = $date;
        $updatedAt = $date;

        if (!$id):
            $query_customer_insert = "INSERT INTO `customer`(`firstName`,`lastName`,`phone`,`email`,`status`,`createdAt`) VALUES ('$firstName','$lastName','$phone','$email','$status','$createdAt')";
            $result_customer_insert = $adapter->insert($query_customer_insert);
            if (!$result_customer_insert):
                throw new Exception("Data is not inserted in customer(result).", 1);
            endif;
            return $result_customer_insert;

        else:
            $query_customer_update = "UPDATE customer 
			SET firstName='$firstName', lastName='$lastName', phone='$phone', email='$email', status='$status', updatedAt='$updatedAt' WHERE id = '$id'";
            $result_customer_update = $adapter->update($query_customer_update);
            if (!$result_customer_update)
            {
                throw new Exception("Data is not updated in customer.", 1);
            }
            return $id;
        endif;

    }

    protected function saveAddress($id)
    {
        $request = new Model_Core_Request();
        $adapter = new Model_Core_Adapter();
        $getSaveAddressData = $request->getPost('address');
        $address = $getSaveAddressData['address'];
        $postalCode = $getSaveAddressData['postalCode'];
        $city = $getSaveAddressData['city'];
        $state = $getSaveAddressData['state'];
        $country = $getSaveAddressData['country'];
        $billing = $getSaveAddressData['billing'];
        $shipping = $getSaveAddressData['shipping'];

        $addressData = $adapter->fetchRow("SELECT * FROM address WHERE customerId = '$id'");

        if (!$addressData): +$query_address_insert = "INSERT INTO `address`( `customerId`, `address`, `postalCode`, `city`, `state`, `country`, `billing`,`shipping`) VALUES ('$id','$address','$postalCode','$city','$state','$country','$billing' ,'$shipping')";
            $result_address_insert = $adapter->insert($query_address_insert);
            if (!$result_address_insert):
                throw new Exception("Data is not inserted in address(result).", 1);
            endif;

        else:
            $query_address_update = "UPDATE address 
			SET address='$address', postalCode='$postalCode', city='$city', state='$state', country='$country', billing='$billing', shipping='$shipping' WHERE customerId = '$id'";
            $result_address_update = $adapter->update($query_address_update);
            if (!$result_address_update):
                throw new Exception("Data is not updated in address.", 1);
            endif;

        endif;

    }

    public function saveAction()
    {
        try
        {
            $id = $this->saveCustomer();
            $this->saveAddress($id);
            $this->redirect($this->getUrl('grid','customer',null,true));
        }

        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        Ccc::getBlock('Customer_Add')->toHtml();
    }

    public function editAction()
    {
        try{
            $id = (int)$this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception("Error Processing Request", 1);
            }
            $customerModel = Ccc::getModel('Customer');
            $customer = $customerModel->fetchRow("SELECT c.*, a.* from customer c left join address a on c.id = a.customerId WHERE c.id = $id");
            if(!$customer){
                throw new Exception("Error Processing Request", 1);
            }
            Ccc::getBlock('Customer_Edit')->addData('customer', $customer)->toHtml();
            
            }catch(Exception $e){
                echo $e->getMessage();
            }
    }

    public function deleteAction()
    {
        $adapter = new Model_Core_Adapter();
        $request = new Model_Core_Request();
        $getUpdateData = $request->getRequest('id');
        $id = $getUpdateData;
        $result = $adapter->delete("DELETE FROM `customer` WHERE `id` = '$id'");
        $result = $adapter->delete("DELETE FROM `address` WHERE `customerId` = '$id'");

        if ($result)
        {
            $this->redirect($this->getUrl('grid','customer',null,true));
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}
?>
