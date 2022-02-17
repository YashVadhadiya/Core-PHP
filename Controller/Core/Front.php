<?php 
//Ccc::loadClass('Controller_Core_Front');

class Controller_Core_Front
{
    protected $request = null;

    public function getRequest()
    {
        if(!$this->request)
        {
            $request = new Model_Core_Request();
            $this->setRequest($request);
        }
        return $this->request;
    }

    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function init()
    {
        $actionName = (isset($_GET['a'])) ? $_GET['a'] : 'error';
		$actionName = $actionName.'Action';
		$controllerName = (isset($_GET['c'])) ? ucfirst($_GET['c']) : 'admin';
		$controllerPath = 'Controller/'.$controllerName.'.php';
		$controllerClassName = 'Controller_'.$controllerName;
        $controllerClassName1 = $this->prepareClassName($controllerClassName);
		Ccc::loadClass($controllerClassName);
		$controller = new $controllerClassName();
		$controller->$actionName();
    }

    public function prepareClassName($name)
	{
		$name = ucwords($name , "_");
		return $name;
	}
}
?>