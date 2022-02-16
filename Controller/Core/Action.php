<?php 
Ccc::loadClass('Model_Core_View');

class Controller_Core_Action{

    public $view = null; 

	public function redirect($url)
    {
        header("location:$url");
        exit();
    }

    public function getView()
    {
        if(!$this->view){
            $this->setView(new Model_Core_View());
        }
        return $this->view;
    }

    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function getAdapter()
    {
        global $adapter;
        return $this->adapter;
    }
}

?>