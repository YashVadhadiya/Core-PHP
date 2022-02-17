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
        //$adminTable->insert(['firstName' => 'Yash', 'lastName' => 'Patel', 'email' => 'yash@mail', 'password' => 'yash123' , 'status' => '1' ]);
        // $adminTable->setPrimaryKey('adminId');
        // $adminTable->update(['firstName' => 'Yash' , 'lastName' => 'Vadhadiya'], ['id' => 9]);
        // $adminTable->delete(['id' => 5]); 
        // $adminTable->fetchRow("select * from admin where id = 10");
        // $adminTable->fetchAll("select * from admin");
    }

    public function gridAction()
    {
        $adminTable = new Model_Admin();
        //$this->getUrl();
        //$this->getUrl('save','category',['id' => 5,'tab' => null], false); //index.php?c=category&a=save&id=5
        /*$this->getUrl(); //index.php?c=category&a=grid&id=5&tab=menu
        $this->getUrl('save'); //index.php?c=category&a=save&id=5&tab=menu
        $this->getUrl('save','admin'); //index.php?c=admin&a=save&id=5&tab=menu
        $this->getUrl('save','category',['id' => 10]); //index.php?c=category&a=save&id=10&tab=menu
        $this->getUrl('save','category',['id' => 10,'tab' => 'hello']); //index.php?c=category&a=save&id=10&tab=hello
        $this->getUrl('save','category',['id' => 5,'tab' => null]); //index.php?c=category&a=save&id=5
        $this->getUrl('save','category',null,true); //index.php?c=category&a=save
        $this->getUrl(null,'category',null,true); //index.php?c=category&a=grid
        $this->getUrl(null,'category',['module' => 'Admin'],true); //index.php?c=category&a=grid&module=Admin*/

         $adapter = new Model_Core_Adapter();
         $admins = $adminTable->fetchAll("select * from admin");//$adapter->fetchAll("SELECT * FROM admin");
         $view = $this->getView();
         $view->addData('admins', $admins);
         $view->setTemplate('view/Admin/grid.php');
         $view->toHtml();
    }

    protected function saveAdmin()
    {
        $adminTable = new Model_Admin();
        
        if (!isset($_POST['admin']['id']))
        {
            throw new Exception("Data is not inserted in admin(isset).", 1);
        }
        $date = date('Y-m-d H:i:s');
        $request = new Model_Core_Request();
        //global $request;
        $adapter = new Model_Core_Adapter();
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
            $result_admin_insert = $adminTable->insert(['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'password' => $password , 'status' => $status ]);

            /*$query_admin_insert = "INSERT INTO `admin`(`firstName`,`lastName`,`password`,`email`,`status`,`createdAt`) VALUES ('$firstName','$lastName',md5('$password'),'$email','$status','$createdAt')";
            $result_admin_insert = $adapter->insert($query_admin_insert);*/
            if (!$result_admin_insert):
                throw new Exception("Data is not inserted in admin(result).", 1);
            endif;
            return $result_admin_insert;

        else:
            $result_admin_update = $adminTable->update(['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'password' => $password , 'status' => $status ], ['id' => $id]);

            /*$query_admin_update = "UPDATE admin 
			SET firstName='$firstName', lastName='$lastName', password=md5('$password'), email='$email', status='$status', updatedAt='$updatedAt' WHERE id = '$id'";
            $result_admin_update = $adapter->update($query_admin_update);*/
            if (!$result_admin_update)
            {
                throw new Exception("Data is not updated in admin.", 1);
            }
            return $id;
        endif;
    }

    public function saveAction()
    {
        $adminTable = new Model_Admin();
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
        $adminTable = new Model_Admin();
        $adapter = new Model_Core_Adapter();
        $view = $this->getView();
        $view->setTemplate('view/Admin/add.php');
        $view->toHtml();
    }

    public function editAction()
    {
        $adminTable = new Model_Admin();
        //global $request;
        $request = new Model_Core_Request();
        $adapter = new Model_Core_Adapter();
        $getUpdateData = $request->getRequest('id');
        $id = $getUpdateData;
        $admins =$adminTable->fetchRow("select * from admin where id = $id"); //$adapter->fetchRow("SELECT * FROM `admin` WHERE `id` = $id");
        $view = $this->getView();
        $view->addData('admins', $admins);
        $view->setTemplate('view/Admin/edit.php');
        $view->toHtml();
    }

    public function deleteAction()
    {
        $adminTable = new Model_Admin();
        $request = new Model_Core_Request();
        //global $request;
        $adapter = new Model_Core_Adapter();
        $getDelete = $request->getRequest('id');
        $id = $getDelete;
        $result = $adminTable->delete(['id' => $id]); 
        /*$result = $adapter->delete("DELETE FROM `admin` WHERE `id` = '$id'");*/
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
