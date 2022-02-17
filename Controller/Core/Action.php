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
        if (!$this->view) {
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

    public function getUrl(
        $action = null,
        $controller = null,
        array $parameters = null,
        $resetParam = false) 
    {
        echo "<pre>";
        $uri = $_SERVER["REQUEST_URI"];
        $query_str = parse_url($uri, PHP_URL_QUERY);
        parse_str($query_str, $queryParams);
        //print_r($queryParams); // cur url  in arry
        //print_r($query_str);  //cur url in string

        $array = [
            "c" => $controller,
            "a" => $action,
        ];
        $result5 = http_build_query($array);

        $ad = array_merge($queryParams, $array);
        $result4 = http_build_query($ad); //c a cur url
        //echo $result4;
        //exit();

        $abc = array_merge($array, $parameters);
        $result3 = http_build_query($abc); // c a parameter
        //echo $result3;

        $var = array_merge($queryParams, $abc);
        //print_r($var);                             // all
        $result1 = http_build_query($var);

        if ($action != null) 
        {
            if ($controller != null) 
            {
                if ($parameters != null) 
                {
                    echo $result1;
                    exit();
                }
                echo $result4;
                exit();
            }
            echo $result5;
            exit();
        }
        echo $query_str;
        exit();

        /*
        //print_r($parameters);
       //$result1 = http_build_query($array);
       //$result2 = http_build_query($parameters); 
       //print_r($url1 = $result1 . '&' . $result2);
       
    /* 
        $action = null;
        $controller = null;
        $parameters = [];

    */
        // $resetParam = false;
    }
}

?>