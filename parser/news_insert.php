<?php
require_once("../api.php");
if(isset($_FILES['file'])){
	//

	$validate = new ValidateUploadPicture("../assets/img/news/"); //constructor injection - string
	$res = $validate->Validate($_FILES['file']);   //method injection - array
	$res = json_decode($res);  //return stdClass

	  if($res->data=="success"){

		$title = $_POST['title'];
		$content = $_POST['content'];
		$dateadded = $_POST['date'];

		$arr = array('title' => $title,
					 'content'=>$content,
				 	 'dateadd'=>$dateadded);

		$validate = new Validation();
 		$validate->Validate($arr);

 		$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
 		$targetPath =  "../assets/img/news/".$_FILES['file']['name']; // Target path where file is to be stored
 		move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file

		$dateadded = $dateadded." 00:00:00";
		$path = $_FILES['file']['name'];
		$qry ="INSERT INTO `tblnews`(`title`,`content`,`imagepath`,`dateadded`)VALUES('".filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES)."','".filter_var($content, FILTER_SANITIZE_MAGIC_QUOTES)."','$targetPath','$dateadded');";

		$con = new ConnectionDB();
		$api = new Api($con);
		$res =  $api->ExecuteNonQuery($qry);

		echo $res;
		exit();
	}
	echo json_encode(array("status"=>$res->status,"data"=>$res->data));
	exit();
}
echo json_encode(array("status"=>"failed","data"=>"failed"));
exit();
?>
