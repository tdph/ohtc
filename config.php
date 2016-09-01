<?php

interface IConnectionDB{
   public function connect();
}

class ConnectionDB implements IConnectionDB {
  var $host = 'localhost';
  var $uid = 'root';
  var $pwd = 'root';
  var $db = 'ohtcdb';
  var $port = '3306';

  public function __construct(){}
  /**
   * @return newly created connection to the database otherwise it will return the error
   **/
  public function connect() {
      date_default_timezone_set("Asia/Manila");
      $conn =  @mysqli_connect($this->host, $this->uid, $this->pwd,$this->db, $this->port) or die('ERROR: Unable to connect to database.');
      // Check connection
      if ($conn->connect_errno){
          die("Connection failed: " . $conn->connect_error);
          /* close connection */
          exit();
      }
      else { if(mysqli_query($conn, "SET time_zone = '+8:00';")){} }
      return $conn;
  }
}
?>
