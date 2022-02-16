<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Admin');
Ccc::loadClass('Model_Core_Request');
?>
<?php
class Controller_Admin extends Controller_Core_Action
{
    public function testAction()
    {
        $adminTable = new Model_Admin();
        $adminTable->insert(['firstName' => 'Yash', 'lastName' => 'Patel', 'email' => 'yash@mail', 'password' => 'yash123' , 'status' => '1' ]);
        // $adminTable->setPrimaryKey('adminId');
        // $adminTable->update(['firstName' => 'Yash' , 'lastName' => 'Vadhadiya'], ['id' => 9]);
        // $adminTable->delete(['id' => 5]);
        // $adminTable->fetchRow("select * from admin where id = 10");
        // $adminTable->fetchAll("select * from admin");
    }

    public function gridAction()
    {
        global $adapter;
        $admins = $adapter->fetchAll("SELECT * FROM admin");
        $view = $this->getView();
        $view->addData('admins', $admins);
        $view->setTemplate('view/Admin/grid.php');
        $view->toHtml();
    }

    protected function saveAdmin()
    {
        
        if (!isset($_POST['admin']['id']))
        {
            throw new Exception("Data is not inserted in admin(isset).", 1);
        }
        $date = date('Y-m-d H:i:s');
        $request = new Model_Core_Request();
        //global $request;
        global $adapter;
        $getSaveData = $request->getPost('admin');
        $id = $getSaveData['id'];
        $firstName = $getSaveData['firstName'];
        $lastName = $getSaveData['lastName'];
        $email = $getSaveData['email'];
        $password = $getSaveData['password'];
        $status = $getSaveData['status'];
        $createdAt = $date;
        $updatedAt = $date;

        if (!$id):
            $query_admin_insert = "INSERT INTO `admin`(`firstName`,`lastName`,`password`,`email`,`status`,`createdAt`) VALUES ('$firstName','$lastName',md5('$password'),'$email','$status','$createdAt')";
            $result_admin_insert = $adapter->insert($query_admin_insert);
            if (!$result_admin_insert):
                throw new Exception("Data is not inserted in admin(result).", 1);
            endif;
            return $result_admin_insert;

        else:
            $query_admin_update = "UPDATE admin 
			SET firstName='$firstName', lastName='$lastName', password=md5('$password'), email='$email', status='$status', updatedAt='$updatedAt' WHERE id = '$id'";
            $result_admin_update = $adapter->update($query_admin_update);
            if (!$result_admin_update)
            {
                throw new Exception("Data is not updated in admin.", 1);
            }
            return $id;
        endif;
    }

    public function saveAction()
    {
        try
        {
            $id = $this->saveAdmin();
            $this->redirect('index.php?c=admin&a=grid');
        }

        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        global $adapter;
        $view = $this->getView();
        $view->setTemplate('view/Admin/add.php');
        $view->toHtml();
    }

    public function editAction()
    {
        //global $request;
        $request = new Model_Core_Request();
        global $adapter;
        $getUpdateData = $request->getRequest('id');
        $id = $getUpdateData;
        $admins = $adapter->fetchRow("SELECT * FROM `admin` WHERE `id` = $id");
        $view = $this->getView();
        $view->addData('admins', $admins);
        $view->setTemplate('view/Admin/edit.php');
        $view->toHtml();
    }

    public function deleteAction()
    {
        $request = new Model_Core_Request();
        //global $request;
        global $adapter;
        $getDelete = $request->getRequest('id');
        $id = $getDelete;
        $result = $adapter->delete("DELETE FROM `admin` WHERE `id` = '$id'");
        if ($result)
        {
            header('Location: index.php?c=admin&a=grid');
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}
?>
