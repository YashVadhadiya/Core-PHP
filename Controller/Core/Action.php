<?php

Ccc::loadClass("Model_Core_View");

class Controller_Core_Action
{
    public $view = null;

    public function redirect($url)
    {
        header("location:$url");
        exit();
    }

    public function getView()
    {
        if (!$this->view) 
        {
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
        return Ccc::getFront()->getRequest();
    }


    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function getAdapter()
    {
        $adapter = new Model_Core_Adapter();
        return $adapter;
    }

    public function getUrl($action = null, $controller = null, array $parameters = null, $reset = false) 
    {
        $resultUrl = [];
        if(!$controller)
        {
            $resultUrl['c'] = $this->getRequest()->getRequest('c'); 
        }

        else
        {
            $resultUrl['c'] = $controller;
        }

        if(!$action)
        {
            $resultUrl['a'] = $this->getRequest()->getRequest('a'); 
        }
        
        else
        {
            $resultUrl['a'] = $action;
        }

        if($reset)
        {
            if($parameters)
            {
                $resultUrl = array_merge($resultUrl, $parameters);
            }
        }
        
        else
        {
            $resultUrl = array_merge($this->getRequest()->getRequest(), $resultUrl);
        
            if($parameters)
            {
                $resultUrl = array_merge($resultUrl, $parameters);
            }
        }
        
        $url = 'index.php?'.http_build_query($resultUrl);
        return $url;
    }
}

?>