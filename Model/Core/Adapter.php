<?php 
echo "<pre>";

class Model_Core_Adapter{
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
        if($result){
            return $this->getConnect()->insert_id;
        }
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
    //join method
    public function join($query)
    {
        $result = $this->query($query);
        return $result;
    }
    //select method
    public function select($query)
    {
        $result = $this->query($query);
        return $result;
    }
    //fetchRow method
    public function fetchRow($query)
    {
        $result = $this->query($query);
        if($result->num_rows){
           return $result->fetch_assoc();   
       }
       return false;
   }
    //fetchAll method
   public function fetchAll($query , $mode= MYSQLI_ASSOC)
   {
    $result = $this->query($query);
    if($result->num_rows){
        return $result->fetch_all($mode);
    }
    return false;
}

public function fetchPairs($query)
{
    $result = $this->fetchAll( $query , MYSQLI_NUM);

    if(!$result){
        return false;
    }
    $keys = array_column($result, "0");
    $values = array_column($result, "1");
    if(!$values){
        $values = array_fill(0, count($keys), null);
    }
    $result = array_combine($keys,$values);
    return $result;
}

public function fetchOne($query)
{
    $result = $this->fetchRow($query);
    if(!$result){
        return false;
    }
    $popElement = array_pop($result);
    return $popElement;
}

}

$adapter = new Model_Core_Adapter();

?>