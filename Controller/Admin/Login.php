<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 
class Controller_Admin_Login extends Controller_Core_Action
{
	public function loginAction()
	{
		if(Ccc::getModel('Admin_Login')->isLoggedIn())
		{
			$this->redirect($this->getLayout()->getUrl('grid','admin',null,true));
		}
		echo Ccc::getBlock('Admin_Login')->toHtml();
	}

	public function logoutAction()
	{
		try 
		{
			$result = Ccc::getModel('Admin_Login')->logout();
			if(!$result)
			{
				throw new Exception("Invalid Request.");
			}
			$this->redirect($this->getLayout()->getUrl('logout','admin_login',null,true));
		} 
		catch (Exception $e) 
		{
			echo 'Invalid Login Request';
		}
	}

	public function loginPostAction()
	{
		try 
		{
			$message = $this->getMessage();
			if(!array_key_exists('admin', $this->getRequest()->getRequest()))
			{
				throw new Exception("Invalid Request.");
				
			}
			$adminData = $this->getRequest()->getRequest('admin');
			$result = Ccc::getModel('Admin_Login')->login($adminData['email'], $adminData['password']);
			if (!$result) 
			{
				throw new Exception("Try Again Something Went Wrong!!!");
			}
			$message->addMessage("Logged In successfully.");
			$this->redirect($this->getLayout()->getUrl('index','product',null,true));
		} 
		catch (Exception $e) 
		{
			$message = $this->getMessage();
			$message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('login'));
		}
	}

}