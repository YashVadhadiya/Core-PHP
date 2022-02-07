<?php require_once('Model/Core/Adapter.php');  ?>
<?php 

class Ccc
{
	public static function loadFile($path)
	{
		require_once($path);
	}
	public static function loadClass($className)
	{
		$path = str_replace("_", "/", $className).'.php';
		Ccc::loadFile($path);
	}
	public static function init()
	{
		$actionName = (isset($_GET['a'])) ? $_GET['a'] : 'error';
		$actionName = $actionName.'Action';
		$controllerName1 = (isset($_GET['c'])) ? ucfirst($_GET['c']) : 'customer';
        $controllerName2 = (isset($_GET['c'])) ? ucfirst($_GET['c']) : 'category';
        $controllerName3 = (isset($_GET['p'])) ? ucfirst($_GET['p']) : 'product';
		$controllerPath = 'Controller/'.$controllerName1.'.php';
		$controllerClassName = 'Controller_'.$controllerName1;
        $controllerPath = 'Controller/'.$controllerName2.'.php';
		$controllerClassName = 'Controller_'.$controllerName2;
        $controllerPath = 'Controller/'.$controllerName3.'.php';
		$controllerClassName = 'Controller_'.$controllerName3;
		Ccc::loadClass($controllerClassName);
		$controller = new $controllerClassName();
		$controller->$actionName();
	}
}

Ccc::init();

?>