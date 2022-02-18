<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
Ccc::loadClass('Model_Admin');
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
        Ccc::getBlock('Admin_Grid')->toHtml();
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

            if (!$result_admin_insert):
                throw new Exception("Data is not inserted in admin(result).", 1);
            endif;
            return $result_admin_insert;

        else:
            $result_admin_update = $adminTable->update(['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'password' => $password , 'status' => $status ], ['id' => $id]);

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
            $this->redirect($this->getUrl('grid','admin',null,true));
        }

        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        Ccc::getBlock('Admin_Add')->toHtml();
    }

    public function editAction()
    {
        try{
            $id = (int)$this->getRequest()->getRequest('id');
            if(!$id){
                throw new Exception("Error Processing Request", 1);
            }
            $adminModel = Ccc::getModel('Admin');
            $admin = $adminModel->fetchRow("SELECT * FROM admin WHERE id = $id");
            if(!$admin){
                throw new Exception("Error Processing Request", 1);
            }
            Ccc::getBlock('Admin_Edit')->addData('admin', $admin)->toHtml();
            }catch(Exception $e){
                echo $e->getMessage();
        }
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
        if ($result)
        {
            $this->redirect($this->getUrl('grid','admin',null,true));
        }
    }

    public function errorAction()
    {
        echo "error";
    }
}
?>
