<?php 
Ccc::loadClass('Block_Core_Template');
class Block_Config_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/config/grid.php');
	}

	public function getConfigs()
	{
		$config = Ccc::getModel('Config');
		$configs = $config->fetchAll("SELECT * FROM config");
		return $configs;
	}
}

