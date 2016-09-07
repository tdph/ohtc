<?php
require_once("./api.php");

if(isset($_FILES['file']) && isset($_POST['title']) && isset($_POST['content']) && isset($_POST['date'])) {

	$validate = new ValidateUploadPicture("../".""); //constructor injection - string
	$res = $validate->Validate($_FILES['file']);   //method injection - array
	$res = json_decode($res);  //return stdClass

	  if($res->data=="success"){

			$title = $_POST['title'];
			$content = $_POST['content'];

			$arr = array('title' => $title,
						 'content'=>$content);
			$validate = new Validation();
			$validate->Validate($arr);

			$qry ="INSERT INTO `tblnews`(`title`,`content`)VALUES('$title','$content');";

			$con = new ConnectionDB();
			$api = new Api($con);
			$res =  $api->ExecuteNonQuery($qry);
			echo $res;
			exit();
		}
}
echo "failed";
exit();
?>
