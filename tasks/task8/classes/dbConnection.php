<?php 

class DB{
    private $server = "localhost";
    private $dbName = "group12";
    private $dbUser = "root";
    private $dbPassword= "";
    public $con; 

    public function __construct(){
        $this->con =  mysqli_connect($this->server,$this->dbUser,$this->dbPassword,$this->dbName);
       if(!$this->con ){
        die('Error '.mysqli_connect_error() );
        }
    }
    public function doQuery($sql){
        $result = mysqli_query($this->con, $sql);
        return $result;
    }
    public function DBRemove($table, $id){

    $sql = "delete from $table where id = $id";
    $op  = mysqli_query($this->con, $sql);

    if ($op) {
        $status = true;
    } else {
        $status = false;
    }
    mysqli_close($this->con);

    return $status;
    }
    function __destruct(){
        mysqli_close($this->con );
    }
    

}
?>