<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php
class Controller_Admin extends Controller_Core_Action
{
    public function indexAction()
    {
        $content = $this->getLayout()->getContent();
        $adminGrid = Ccc::getBlock('Admin_Index');
        $content->addChild($adminGrid);
        $this->renderLayout();
    }

    public function gridBlockAction()
    {
     $adminGrid = Ccc::getBlock("Admin_Grid")->toHtml();
     $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
     $response = [
        'status' => 'success',
        'content' => $adminGrid,
        'message' => $messageBlock,
    ] ;
    $this->renderJson($response);
}

public function addBlockAction()
{
    $admin = Ccc::getModel('admin');
    Ccc::register('admin',$admin);
    $adminAdd =$this->getLayout()->getBlock('Admin_Edit')->toHtml();
    $response = [
        'status' => 'success',
        'content' => $adminAdd
    ];
    $this->renderJson($response);
}

public function editBlockAction()
{
    $id = (int) $this->getRequest()->getRequest('id');
    if(!$id)
    {
        throw new Exception("Id not valid.");
    }
    $adminModel = Ccc::getModel('admin')->load($id);
    $admin = $adminModel->fetchRow("SELECT * FROM `admin` WHERE `id` = $id");
    Ccc::register('admin',$adminModel);

    if(!$admin)
    {
        throw new Exception("unable to load admin.");
    }
    $content = $this->getLayout()->getContent();
    $adminEdit = Ccc::getBlock("Admin_Edit")->toHtml();
    $response = [
        'status' => 'success',
        'content' => $adminEdit
    ];
    $this->renderJson($response);
}

public function saveAction()
{
    $admin = Ccc::getModel('Admin');
    $date = date('Y-m-d H:i:s');
    $getSaveData = $this->getRequest()->getRequest('admin');
    $message = $this->getMessage();

    try
    {
        if (!$getSaveData)
        {
            throw new Exception("You can not insert data in admin.");
        }

        $adminId = (int)$this->getRequest()->getRequest('id');
        $admin = Ccc::getModel('Admin')->load($adminId);
        
        if(!$admin)
        {
            $admin = Ccc::getModel('Admin');
            $admin->createdAt = $date;
            $admin->setData($getSaveData);
            $admin->password = md5($getSaveData['password']);
        }
        else
        {
            $admin->setData($getSaveData);
            $admin->updatedAt = $date;
            $admin->password = md5($getSaveData['password']);
        }

        $result = $admin->save();

        if (!$result) 
        {
            throw new Exception("System is not able to update");
        } 
        else 
        {
            $message->addMessage('Updated Successfully.');
            $this->redirect($this->getLayout()->getUrl('gridBlock', 'admin', null, true));
        }
    }
    
    catch (Exception $e) 
    {
        $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
        $this->redirect($this->getLayout()->getUrl('gridBlock', 'admin', ['id' => null], true));
    }
}

public function deleteAction()
{
    $getDelete = $this->getRequest()->getRequest('id');
    $admin = Ccc::getModel('Admin')->load($getDelete);
    $result = $admin->delete();
    $message = $this->getMessage();
    if ($result)
    {
        $message->addMessage('Deleted Successfully.');
        $this->redirect($this->getLayout()->getUrl('gridBlock', 'admin', null, true));
    }
}
} 
?>
