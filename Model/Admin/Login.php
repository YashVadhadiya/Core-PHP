<?php 

class Model_Admin_Login
{
	public function login($email, $password)
	{
		$password = md5($password);
		$admin = Ccc::getModel('Admin')->fetchRow("SELECT * FROM admin WHERE email = '$email'");
		if(!$admin)
		{
			return false;
		}

		if ($admin->password == $password) 
		{
			Ccc::getModel('Admin_Session')->login = $admin;
			return true;
		}

		else
		{
			return false;
		}
	}

	public function logout()
	{
		if (!$this->isLoggedIn()) 
		{
			return false;
		}
		unset(Ccc::getModel('Admin_Session')->login);
		return true;
	}

	public function isLoggedIn()
	{
		$session = Ccc::getModel('Admin_Session');
		if(!$session->login)
		{
			return false;
		}
		return true;
	}
}