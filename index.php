<?php 
require_once('Model/Core/Adapter.php'); 
date_default_timezone_set("Asia/Kolkata");
?>

<?php
echo "<pre>";
class Ccc
{
	protected $front = null;

	public function getFront()
	{
		Ccc::loadClass('Controller_Core_Front');
		if(!$this->front)
		{
			$front = new Controller_Core_Front();
			$this->setFront($front);
		}
		return $this->front;
	}

	public function setFront($front)
	{
		$this->front = $front;
		return $this;
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
	public function init()
	{
		$this->getFront()->init();
	}
}

$initObj = new Ccc();
$initObj->init();

?>