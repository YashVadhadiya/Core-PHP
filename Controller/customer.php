<?php 
require_once('Model/Core/Adapter.php');
?>
<?php
class Controller_Customer{
    public function gridAction()
    {
        require_once('view/Customer/grid.php');
    }
    
    public function saveAction()
    {
        $adapter = new Model_Core_Adapter();
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d H:i:s');
        
        $id = $_POST['customer']['id'];
        $firstName = $_POST['customer']['firstName'];
        $lastName = $_POST['customer']['lastName'];
        $email = $_POST['customer']['email'];
        $phone = $_POST['customer']['phone'];
        $status = $_POST['customer']['status'];
        $createdAt = $date;
        $updatedAt = $date;
        $addressId = $_POST['address']['addressId'];
        $customerId = $_POST['address']['customerId'];
        $address = $_POST['address']['address'];
        $postalCode = $_POST['address']['postalCode'];
        $city = $_POST['address']['city'];
        $state = $_POST['address']['state'];
        $country = $_POST['address']['country'];
        $billing = $_POST['address']['billing'];
        $shipping = $_POST['address']['shipping'];
        
        try{
            if($id == NULL){
            
            $query_customer_insert = "INSERT INTO customer (firstName, lastName, email, phone, status, createdAt) VALUES ('$firstName', '$lastName', '$email', '$phone', '$status', '$createdAt')";
            
            $result_customer_insert = $adapter->insert($query_customer_insert);
            
            if(!$result_customer_insert){
            throw new Exception("Data in not inserted in customer.", 1);
            }
            
            $query_address_insert = "INSERT INTO address (customerId, address, postalCode, city, state, country, billing, shipping) VALUES ('$result_customer_insert', '$address', '$postalCode', '$city', '$state', '$country', '$billing', '$shipping')";
            
            $result_address_insert = $adapter->insert($query_address_insert);
            
            if(!$result_address_insert){
            throw new Exception("Data in not inserted in address.", 1);

            }else{
                $this->redirect();
            }
            }else{
            $query_customer_update = "UPDATE customer c INNER JOIN address a ON c.id = a.customerId SET c.firstName='$firstName' , c.lastName='$lastName' ,  c.phone='$phone' , c.email='$email' , c.status='$status' , c.updatedAt='$updatedAt' , a.address='$address' , a.postalCode='$postalCode' ,  a.city='$city' , a.state='$state' , a.country='$country' , a.billing='$billing' , a.shipping='$shipping' WHERE c.id = '$id'";

            $result_update = $adapter->update($query_customer_update);
            if(!$result_update){
            throw new Exception("Data in not updated.", 1);
            }
            else{
            $this->redirect();
            }
        }
        }catch(Exception $e){
            $e->getMessage();
        }    
        
    }
    
    public function addAction()
    {
        require_once('view/Customer/add.php');
    }
    
    public function editAction()
    {
        require_once('view/Customer/edit.php');
    }
    
    public function deleteAction()
    {
        $id=$_GET['id'];
        $adapter = new Model_Core_Adapter();
        $result=$adapter->delete("DELETE FROM `customer` WHERE `id` = '$id'");
        $result=$adapter->delete("DELETE FROM `address` WHERE `customerId` = '$id'");
        
        if($result)
        {
            header('Location: index.php?c=customer&a=grid');
        }
    }

    public function redirect()
    {
        header('Location: index.php?c=customer&a=grid');
    }

    public function errorAction()
    {
        echo "error";
    }
}
?>