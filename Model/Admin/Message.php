<?php Ccc::loadClass('Model_Core_Message') ?>
<?php

	class Model_Admin_Message extends Model_Core_Message
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function getSession()	
		{
			if(!$this->session)
			{
				$session = Ccc::getModel('Admin_Session');
				$this->setSession($session);
			}
			return $this->session;
		}
	}