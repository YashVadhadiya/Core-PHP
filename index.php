<?php require_once('Model\Core\Adapter.php'); 
Ccc::loadClass('Controller_Core_Front');
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
date_default_timezone_set("Asia/Kolkata");
$urlAction = new Controller_Core_Action();
 ?>



<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Grid</title>
</head>

<body>
    <!-- this is nav bar code -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light"> <a class="navbar-brand" href="<?php echo $urlAction->getUrl('grid','admin',null,true) ?>">Admin</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','customer',null,true) ?>" name="customer">Customer</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','category',null,true) ?>" name="category">Category</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','product',null,true) ?>" name="Product">Product</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','config',null,true) ?>" name="config">Config</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','salesman',null,true) ?>" name="salesman">Salesman</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','page',null,true) ?>" name="page">Page</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','vendor',null,true) ?>" name="vendor">Vendor</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- nav bar ends -->
</body>
</html>



<?php
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

	public static function getBlock($className)
	{
		$className = 'Block_'.$className;
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