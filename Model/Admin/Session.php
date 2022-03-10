<?php Ccc::loadClass('Model_Core_Session')?>
<?php

	class Model_Admin_Session extends Model_Core_Session
	{
		protected $namespace = null;
		
		public function __construct()
		{
			parent::__construct();
			$this->setNamespace('admin');
		}
	}