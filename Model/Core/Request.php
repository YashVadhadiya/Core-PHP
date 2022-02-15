<?php 
Ccc::loadClass('Controller_Core_Front');

class Model_Core_Request
{
    public function isPost()
    {
        return ($_SERVER['REQUEST_METHOD'] == 'POST') ? true : false;
    }

    public function getRequest($key,$value)
    {
        if(isset($_REQUEST[$key]))
        {
            return $_REQUEST[$key];
        }
        else
        {
            return $value;
        }
    }

    public function getPost($key = null,$value = null)
	{
		if($key == null && $value == null)
        {
            return $_POST;
        }

		elseif($key == null && $value!=null)
		{
			return $_POST[$value];
		}

		else
		{
			if(array_key_exists($key, $_POST))
			{
				return $_POST[$key];
			}
		}
	}

    public function getAction()
    {
        return (isset($_GET['a'])) ? $_GET['a'] : 'error';
    }

    public function getController()
    {
        return (isset($_GET['c'])) ? ucfirst($_GET['c']) : 'admin';
    }

}

?>