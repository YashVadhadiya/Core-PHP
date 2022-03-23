<?php require_once('Model\Core\Adapter.php'); ?>
<?php Ccc::loadClass('Controller_Core_Front');?>
<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php date_default_timezone_set("Asia/Kolkata");?>

<?php
define('DS',DIRECTORY_SEPARATOR);
class Ccc
{
	protected static $front = null;

	public static function getFront()
	{
		if(!self::$front)
		{
			Ccc::loadClass('Controller_Core_Front');
			$front = new Controller_Core_Front();
			self::setFront($front);
		}
		return self::$front;
	}

	public static function register($key , $value)	
	{
		$GLOBALS[$key] = $value;
	}

	public static function getRegistry($key)
	{
		if(array_key_exists($key , $GLOBALS))
		{
			return $GLOBALS[$key];
		}
		return null;
	}

	public static function unregister($key)
	{
		if(array_key_exists($key , $GLOBALS))
		{
			unset($GLOBALS[$key]);
		}
	}

	public static function getConfig($key)
	{

		if(!($config = self::getRegistry('config')))
		{
			$config = self::loadFile('etc/config.php');
			self::register('config' , $config);
		}
		if(array_key_exists($key,$config))
		return $config[$key];
	}
	
	public static function setFront($front)
	{
		self::$front = $front;
	}
	
	public static function loadFile($path)
	{	
		return require_once($path); 
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

	public static function getBaseUrl($subUrl)
	{
		$url = self::getConfig('baseUrl');
        if($subUrl){
            $url = $url.$subUrl;
        }
        return $url;
	}

	public static function getBasePath($subPath)
	{
		$path = self::getConfig('basePath');
        if($subPath){
            $path = $path.$subPath;
        }
        return $path;
	}

	public static function init()
	{
		self::getFront()->init();
	}
}

Ccc::init();

?>