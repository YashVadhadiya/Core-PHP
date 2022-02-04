<?php 
echo "<pre>";

class Adapter{
    public $config = [
        'host'=>'localhost:3305',
        'user'=>'root',
        'password'=>'',
        'dbname'=>'crud_oop'
    ];
    private $connect = NULL;
    public function connect()
    {
        $connect = mysqli_connect(  $this->config['host'],
                                    $this->config['user'],
                                    $this->config['password'],
                                    $this->config['dbname']);
        $this->setConnect($connect);
        return $connect;
    }
    //setConnect method
    public function setConnect($connect)
    {
        $this->connect = $connect;
        return $this;
    }
    //getConnect method
    public function getConnect()     
    {
        return $this->connect;
    }
    //setConfig method
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }
    //getConfig method
    public function getConfig()     
    {
        return $this->config;
    }
    //query method
    public function query($query)
    {
        if(!$this->getConnect()){
            $this->connect();
        }
        $result = $this->getConnect()->query($query);
        return $result;
 
    }
    //insert method
    public function insert($query)
    {

        $result = $this->query($query);
        return $result;
    }
    //update method
    public function update($query)
    {
        $result = $this->query($query);
        return $result;
    }
    //delete method
    public function delete($query)
    {
        $result = $this->query($query);
        return $result;
    }

    public function fetchAll($query)
    {
        $result = $this->query($query);
        return $result;
    }
    public function fetchRow($query)
	{
		$result = $this->query($query);
		if($result->num_rows){
			return $result->fetch_assoc();
		}
		return false;
	}


}
$adapter = new Adapter();

?>