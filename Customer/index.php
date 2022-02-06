<?php 
require_once('Adapter.php');
?>
<?php
class Customer{
    public function gridAction()
    {
        require_once('customer-grid.php');
    }
    
    public function saveAction()
    {
        $adapter = new Adapter();
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
        
        if($id == NULL):
        
            $query_customer_insert = "INSERT INTO customer (firstName, lastName, email, phone, status, createdAt) VALUES ('$firstName', '$lastName', '$email', '$phone', '$status', '$createdAt')";
            $result1 = $adapter->insert($query_customer_insert);

            $query_address_insert = "INSERT INTO address (customerId, address, postalCode, city, state, country, billing, shipping) VALUES ('$result1', '$address', '$postalCode', '$city', '$state', '$country', '$billing', '$shipping')";
            $result2 = $adapter->insert($query_address_insert);
            header("Location: index.php?a=gridAction");            
           
        else:
            
            $query_customer_update = "UPDATE customer c INNER JOIN address a ON c.id = a.customerId SET c.firstName='$firstName' , c.lastName='$lastName' ,  c.phone='$phone' , c.email='$email' , c.status='$status' , c.updatedAt='$updatedAt' , a.address='$address' , a.postalCode='$postalCode' ,  a.city='$city' , a.state='$state' , a.country='$country' , a.billing='$billing' , a.shipping='$shipping' WHERE c.id = '$id'";

            $result = $adapter->update($query_customer_update);
            header("Location: index.php?a=gridAction");
        endif;

    }
    
    public function addAction()
    {
        require_once('customer-add.php');
    }
    
    public function editAction()
    {
        require_once('customer-edit.php');
    }
    
    public function deleteAction()
    {
        $id=$_GET['id'];
        $adapter = new Adapter();
        $result=$adapter->delete("DELETE FROM `customer` WHERE `id` = '$id'");
        $result=$adapter->delete("DELETE FROM `address` WHERE `customerId` = '$id'");
        
        if($result)
        {
            header('Location: index.php?a=gridAction');
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}

$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';

$customer = new Customer();

$customer->$action();
?>