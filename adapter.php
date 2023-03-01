<?php
 //make class
class adapter {
    public $config = [
        'host'=>'localhost',
        'username' => 'root',
        'password'=>'',
        'databasename'=>'ecommerce'
    ];

    //connection function
    public $connect = null;

    public function connect(){
        if ($this->connect != null) {
            return $this->connect;
        }
        $connect = mysqli_connect($this->config['host'],$this->config['username'],$this->config['password'],$this->config['databasename']);
        return $connect;
    }

    //FETCHALL FUNCTION
    public function fetchAll($query){
        $connect = $this->connect();
        $result = mysqli_query($connect,$query);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    //2 : FETCHROW
    public function fetchRow($query) {
        $connect = $this->connect(); //call connect function for connection
        $result = mysqli_query($connect,$query);
            if($result->num_rows > 0){
                return $result->fetch_assoc();
            }
                return false;
        }
        
        
}
?>