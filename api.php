<?php
require_once("config.php");

class Vars {
	public static $assets = "assets/";
	public static $img = "assets/img/";
	public static $services = "assets/img/services/";
}

interface IApi {
	public function ExecuteReader($qry);
	public function ExecuteNonQuery($qry);
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

	public function ExecuteNonQuery($qry){
		$result = mysqli_query($this->connection->connect(),$qry) or die("failed");
		if($result===TRUE){ return json_encode(array("status"=>"success","data"=>"success")); }
		else { echo json_encode(array("status"=>"failed","data"=>"failed")); exit(); }
	}
	public function ExecuteLastInsertId(){
			return mysqli_insert_id($this->connection->connect()) ;
	}
}

class Validation implements IValidation{
	public function __construct(){}
	public function Validate($arr) {
		$val = "";
		foreach ( $arr as $key => $value ) {
			if($value==null || trim($value)==""){$val.=$key.","; }
		}
		if($val!=""){   echo json_encode(array("status" => "failed", "data" =>"Empty or null string ".strtoupper(substr($val,0,strlen($val)-1))));  exit(); }
	}

}

class ValidateUploadPicture implements IValidation{

		private $directory = "";
		public function __construct($dir){
				$this->directory = $dir;
		}
		public function Validate($arr){

			$validextensions = array("jpeg", "jpg", "png","JPG","JPEG","PNG");
			$temporary = explode(".", $arr["name"]);
			$file_extension = end($temporary);

				if ((($arr["type"] == "image/png") ||
						 ($arr["type"] == "image/jpg") ||
						 ($arr["type"] == "image/jpeg"))
						 && ($arr["size"] < 5000000)  //Approx. 5mb files can be uploaded.
						 && in_array($file_extension, $validextensions) ) {
							if ($arr["error"] > 0)
							{
									return json_encode(array("status"=>"failed","data"=>$arr["error"] ));
							}
							else
							{
										if (file_exists($this->directory.$arr["name"]))
										{
											 return json_encode(array("status"=>"failed","data"=> $arr["name"]." already exists." ));
										}
										else
										{
											return json_encode(array("status"=>"success","data"=>"success"));
									  }
							}
				 }
				 else
				 {
						 return json_encode(array("status"=>"failed","data"=>"***Invalid file Size or Type***" ));
				 }
		}
}
class ValidatePictureDimension implements IValidation{
		private $fxW,$fxH;

		public function __construct($fixedWith,$fixedHeight){
				$this->fxW = $fixedWith;
				$this->fxH = $fixedHeight;
		}
		public function Validate($arr)//array
		{
				$arr =  getimagesize($arr['tmp_name']);

				if(intval($arr[0])<=$this->fxW && ($this->fxH==0 || intval($arr[1])<=$this->fxH))//validate dimension
				{
						return json_encode(array("status"=>"success","data"=>"success"));
				}
				return json_encode(array("status"=>"failed","data"=>"Invalid Dimension"));
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
