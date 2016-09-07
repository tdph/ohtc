<?php

interface IConnectionDB{
   public function connect();
}

class ConnectionDB implements IConnectionDB {
  var $host = 'localhost';
  var $uid = 'root';
  var $pwd = 'argiedb';
  var $db = 'ohtcdb';
  var $port = '3306';
  private $conn  = null;

   public function __construct(){ $this->CreateConnection(); }
  /**
   * @return newly created connection to the database otherwise it will return the error
   **/
   public function CreateConnection(){

       date_default_timezone_set("Asia/Manila");
       $this->conn =  @mysqli_connect($this->host, $this->uid, $this->pwd,$this->db, $this->port);
       if (!$this->conn) {
           die("Connection failed: 'ERROR: Unable to connect to database.' ");// . mysqli_connect_error());
       }
       // Check connection
       if ($this->conn->connect_errno){
           die("Connection failed: " . $this->conn->connect_error);
           /* close connection */
           exit();
       }
       else { if(mysqli_query($this->conn, "SET time_zone = '+8:00';")){} }
   }
   public function connect() {
      return $this->conn;
  }
}
?>
