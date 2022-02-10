<?php 
require_once('Model/Core/Adapter.php');
?>
<?php
class Controller_Admin{
    public function gridAction()
    {
        require_once('view/Admin/grid.php');
    }

    protected function saveadmin()
	{
        if(!isset($_POST['admin']['id'])){
            throw new Exception("Data is not inserted in admin(isset).", 1);
        }

		$adapter = new Model_Core_Adapter();
		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d H:i:s');
		
		$id=$_POST['admin']['id'];
		$firstName=$_POST['admin']['firstName'];
		$lastName=$_POST['admin']['lastName'];
		$email=$_POST['admin']['email'];
		$password=$_POST['admin']['password'];
		$status = $_POST['admin']['status'];
		$createdAt = $date;
		$updatedAt = $date;

		if(!$id):
			$query_admin_insert = "INSERT INTO `admin`(`firstName`,`lastName`,`password`,`email`,`status`,`createdAt`) VALUES ('$firstName','$lastName',md5('$password'),'$email','$status','$createdAt')";
			$result_admin_insert = $adapter->insert($query_admin_insert);
			if(!$result_admin_insert):
				throw new Exception("Data is not inserted in admin(result).",1);
			endif;
			return $result_admin_insert;
		
        else:
			$query_admin_update ="UPDATE admin 
			SET firstName='$firstName', lastName='$lastName', password=md5('$password'), email='$email', status='$status', updatedAt='$updatedAt' WHERE id = '$id'";
			$result_admin_update = $adapter->update($query_admin_update);
			if(!$result_admin_update){
				throw new Exception("Data is not updated in admin.",1);
			}
			return $id;
		endif;
	}
	public function saveAction()
	{
		try
		{
			$id = $this->saveadmin();
			$this->redirect('index.php?c=admin&a=grid');
		}
		
		catch (Exception $e) {
			echo $e->getMessage();
		}
	}


    
    public function addAction()
    {
        require_once('view/Admin/add.php');
    }
    
    public function editAction()
    {
        require_once('view/Admin/edit.php');
    }
    
    public function deleteAction()
    {
        $id=$_GET['id'];
        $adapter = new Model_Core_Adapter();
        $result=$adapter->delete("DELETE FROM `admin` WHERE `id` = '$id'");        
        if($result)
        {
            header('Location: index.php?c=admin&a=grid');
        }
    }

    public function redirect()
    {
        header('Location: index.php?c=admin&a=grid');
    }

    public function errorAction()
    {
        echo "error";
    }
}
?>