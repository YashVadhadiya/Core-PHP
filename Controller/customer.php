<?php
Ccc::loadClass('Controller_Core_Action');
?>
<?php
class Controller_Customer extends Controller_Core_Action
{

    public function gridAction()
    {
        $adapter = new Model_Core_Adapter();
        $customers = $adapter->fetchAll("SELECT c.*, a.* from customer c left join address a on c.id = a.customerId;");
        $view = $this->getView();
        $view->addData('customers', $customers);
        $view->setTemplate('view/customer/grid.php');
        $view->toHtml();
        //require_once('view/Customer/grid.php');
        
    }

    protected function saveCustomer()
    {
        if (!isset($_POST['customer']['id']))
        {
            throw new Exception("Data is not inserted in customer(isset).", 1);
        }

        $adapter = new Model_Core_Adapter();
        //date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d H:i:s');

        $id = $_POST['customer']['id'];
        $firstName = $_POST['customer']['firstName'];
        $lastName = $_POST['customer']['lastName'];
        $email = $_POST['customer']['email'];
        $phone = $_POST['customer']['phone'];
        $status = $_POST['customer']['status'];
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
        $adapter = new Model_Core_Adapter();
        $address = $_POST['address']['address'];
        $postalCode = $_POST['address']['postalCode'];
        $city = $_POST['address']['city'];
        $state = $_POST['address']['state'];
        $country = $_POST['address']['country'];
        $billing = $_POST['address']['billing'];
        $shipping = $_POST['address']['shipping'];

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
            $this->redirect('index.php?c=customer&a=grid');
        }

        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        $adapter = new Model_Core_Adapter();
        $view = $this->getView();
        $view->setTemplate('view/customer/add.php');
        $view->toHtml();
        //require_once('view/Customer/add.php');
        
    }

    public function editAction()
    {
        $adapter = new Model_Core_Adapter();
        if ($_GET['id'])
        {
            $id = $_GET['id'];
            $customers = $adapter->fetchRow("SELECT c.*, a.* from customer c left join address a on c.id = a.customerId WHERE c.id = $id");
        }
        $view = $this->getView();
        $view->addData('customers', $customers);
        $view->setTemplate('view/customer/edit.php');
        $view->toHtml();
        //require_once('view/Customer/edit.php');
        
    }

    public function deleteAction()
    {
        $id = $_GET['id'];
        $adapter = new Model_Core_Adapter();
        $result = $adapter->delete("DELETE FROM `customer` WHERE `id` = '$id'");
        $result = $adapter->delete("DELETE FROM `address` WHERE `customerId` = '$id'");

        if ($result)
        {
            header('Location: index.php?c=customer&a=grid');
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}
?>
