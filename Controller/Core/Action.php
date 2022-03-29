<?php Ccc::loadClass("Block_Core_Layout"); ?>

<?php

class Controller_Core_Action
{
    protected $layout = null;
    
    protected $message = null; 

    public function __construct()
    {
        $this->authenticate();
    }

    public function authenticate()
    {
        try 
        {
            $message = $this->getMessage();
            $action = $this->getRequest()->getRequest('a');
            $controller = ucwords($this->getRequest()->getRequest('c'),'_');

            if($controller == 'Admin_Login' && ($action == 'login' || $action == 'loginPost'))
            {
                $login = Ccc::getModel('Admin_Login')->isLoggedIn();
                if($login)
                {
                    $message->addMessage('Alrady LoggedIn.');
                    $this->redirect($this->getLayout()->getUrl('grid','product',null,true));
                }
            }
            else
            {
                $login = Ccc::getModel('Admin_Login')->isLoggedIn();
                if(!$login)
                {
                    throw new Exception("Logout Successfully.",1);
                }
            }   
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('login','admin_login',null,true));    
        }   
    }

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

    /*public function renderLayout()
    {
        echo $this->getLayout()->toHtml();
    }*/

    public function getMessage()
    {
        if(!$this->message)
        {
            $this->setMessage(Ccc::getModel('Admin_Message'));
        }
        return $this->message;
    }

     public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    protected function setTitle($title)
    {
        $this->getLayout()->getHead()->setTitle($title);
        return $this;
    }

    public function getResponse()
    {
        return Ccc::getFront()->getResponse();
    }

    /*public function renderLayout()
    {
        echo $this->getLayout()->toHtml();
    }*/

    public function renderLayout()
    {
       echo $this->getResponse()
            ->setHeader('content-type','text/html')
            ->render($this->getLayout()->toHtml());
    }

    public function renderJson($content)
    {
       echo $this->getResponse()
            ->setHeader('content-type','application/json')
            ->render(json_encode($content));
    }
}

?>