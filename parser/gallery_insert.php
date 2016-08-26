<?php
require_once("./api.php");
if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['imagepath'])) {
	$title =    $_POST['title'];
	$description =  $_POST['description'];
	$imagepath =  $_POST['imagepath'];
	$arr = array('title' => $title,
				 'description' => $description,
				 'imagepath' => $imagepath);

	$validate = new Validation();
	$validate->Validate($arr);

	$qry ="INSERT INTO `tblgallery`(`title`,`description`,`imagepath`)VALUES('$title','$description','$imagepath');";

	$con = new ConnectionDB();
	$api = new Api($con);
	$api->ExecuteQuery($qry);
}
echo "failed";
exit();
?>
