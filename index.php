<?php 
Ccc::loadClass('Model_Core_Adapter');
Ccc::loadClass('Model_Core_Request');
Ccc::loadClass('Controller_Core_Front');
Ccc::loadClass('Controller_Core_Action');
date_default_timezone_set("Asia/Kolkata");
?>

<?php
echo "<pre>";
class Ccc
{
	protected static $front = null;

	public function getFront()
	{
		if(!self::$front)
		{
			Ccc::loadClass('Controller_Core_Front');
			$front = new Controller_Core_Front();
			self::setFront($front);
		}
		return self::$front;
	}

	public static function setFront($front)
	{
		self::$front = $front;
	}
	
	public static function loadFile($path)
	{	
		require_once($path); 
	}

	public static function loadClass($className)
	{
		$path = str_replace("_", "/", $className).'.php';
		Ccc::loadFile($path);
	}

	public static function getModel($className)
	{
		$className = 'Model_'.$className;
		self::loadClass($className);
		return new $className;
	}

	public static function init()
	{
		self::getFront()->init();
	}
}

Ccc::init();

?>