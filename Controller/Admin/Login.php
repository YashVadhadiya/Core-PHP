<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Admin_Login extends Controller_Core_Action
{
	public function loginAction()
	{
		if(Ccc::getModel('Admin_Login')->isLoggedIn())
		{
			$this->redirect($this->getLayout()->getUrl('grid','admin',null,true));
		}
		Ccc::getBlock('Admin_Login')->toHtml();
	}

	public function logoutAction()
	{
		try 
		{
			$result = Ccc::getModel('Admin_Login')->logout();
			if(!$result)
			{
				throw new Exception("Some error occur.", 1);
			}
			$this->redirect($this->getUrl('logout','admin_login',null,true));
		} 
		catch (Exception $e) 
		{
			echo 'some error';
		}
	}

	public function loginPostAction()
	{
		try 
		{
			$message = $this->getMessage();
			if(!array_key_exists('admin', $this->getRequest()->getRequest()))
			{
				throw new Exception("Invalid Request.", 1);
				
			}
			$adminData = $this->getRequest()->getRequest('admin');
			$result = Ccc::getModel('Admin_Login')->login($adminData['email'], $adminData['password']);
			if (!$result) 
			{
				throw new Exception("Email Address or Password Incorrect.", 1);
			}
			$message->addMessage("Logged In successfully.");
			$this->redirect($this->getUrl('grid','product',null,true));
		} 
		catch (Exception $e) 
		{
			$message = $this->getMessage();
			$message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('login'));
		}
	}

}