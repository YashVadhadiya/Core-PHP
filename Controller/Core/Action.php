<?php

Ccc::loadClass("Block_Core_Layout");

class Controller_Core_Action
{
    protected $layout = null;

    public function redirect($url)
    {
        header("location:$url");
        exit();
    }

    public function getLayout()
    {
        if (!$this->layout) 
        {
            $this->setLayout(new Block_Core_Layout());
        }
        return $this->layout;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
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

    public function renderLayout()
    {
        return $this->getLayout()->toHtml();
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

    public function getBaseUrl($subUrl = null)
    {
        $url = "C:/xampp-php/htdocs/Cybercom/Core-PHP";
        if($subUrl){
            $url = $url."/".$subUrl;
        }
        return $url;
    }
}

?>