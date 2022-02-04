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
        require_once('customer-add.php');
    }
    public function deleteAction()
    {
        require_once('customer-delete.php');
    }
    public function addAction()
    {
        require_once('customer-add.php');
    }
    public function updateAction()
    {
        require_once('customer-update.php');
    }
    public function errorAction()
    {
        echo "error";
    }
}
$customer = new Customer();
?>