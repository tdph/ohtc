<?php
require_once("./config.php");

interface IApi {
	public function ExecuteReader($qry);
	public function ExecuteQuery($qry);
}


interface IValidation {
	public function Validate($str);
}

class Api implements IApi {
	//declaration
	private $connectionString;

	//constructor
	public function __construct(IConnectionDB $conn){
		$this->connectionString = $conn;
	}

	/**
	* @param string $qry
	* @return row data
	**/
	
	public function ExecuteReader($qry){
		$result = mysqli_query($this->connectionString->connect(),$qry) or die("failed");
		return $result;
	}

	public function ExecuteQuery($qry){
		$result = mysqli_query($this->connectionString->connect(),$qry) or die("failed");
		if($result=="1"){ echo "success"; exit();}
		else { echo "failed"; exit(); }
	}
}

class Validation implements IValidation{
	public function __construct(){}
	public function Validate($arr) {
		$val = "";
		foreach ( $arr as $key => $value ) {
			if($value==null || $value==""){$val.=$key.","; }
		}
		if($val!=""){ echo "Empty or null string ".strtoupper(substr($val,0,strlen($val)-1)); exit(); }
	}
}

?>
