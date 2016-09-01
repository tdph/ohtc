<?php
require_once("config.php");

class Vars {
	public static $assets = "assets/";
	public static $img = "assets/img/";
	public static $services = "assets/img/services/";
}

interface IApi {
	public function ExecuteReader($qry);
	public function ExecuteQuery($qry);
}


interface IValidation {
	public function Validate($str);
}

interface ICondition{
	public function Append( );
}

class Api implements IApi {
	//declaration
	private $connection;

	//constructor
	public function __construct(IConnectionDB $conn){
		$this->connection = $conn;
	}

	/**
	* @param string $qry
	* @return row data
	**/

	public function ExecuteReader($qry){
		$result = mysqli_query($this->connection->connect(),$qry) or die("failed");
		return $result;
	}

	public function ExecuteQuery($qry){
		$result = mysqli_query($this->connection->connect(),$qry) or die("failed");
		if($result=="1"){ echo json_encode(array("status"=>"success","data"=>"success")); exit();}
		else { echo json_encode(array("status"=>"failed","data"=>"failed"));  exit(); }
	}
}

class Validation implements IValidation{
	public function __construct(){}
	public function Validate($arr) {
		$val = "";
		foreach ( $arr as $key => $value ) {
			if($value==null || $value==""){$val.=$key.","; }
		}
		if($val!=""){   echo json_encode(array("status" => "failed", "data" =>"Empty or null string ".strtoupper(substr($val,0,strlen($val)-1))));  exit(); }
	}
}

class Limit implements ICondition{
		private $array;
	  	public function __construct($arr){
				$this->array = $arr;
			}
			public function Append(){
				$page = $this->array['page'];
				$limit = $this->array['limit'];
				$validate = new Validation();
				$validate->Validate($this->array);
				$strtpage = 0;
				if(intval($page)-1>0){
					$strtpage = (intval($page)*intval($limit))-intval($limit);
				}
				return " limit $strtpage,$limit;";
		}
}

?>
