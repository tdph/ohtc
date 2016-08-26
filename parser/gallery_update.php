<?php
require_once("./api.php");
if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['imagepath']) && isset($_POST['id'])) {
	$title =   $_POST['title'];
	$description =   $_POST['description'];
	$imagepath = $_POST['imagepath'];
	$id = $_POST['id'];
	$arr = array('title' => $title,
				 'description' => $description,
				 'imagepath' => $imagepath,
				 'id'=>$id);

	$validate = new Validation();
	$validate->Validate($arr);

	$qry ="UPDATE `tblgallery` SET `title` = '$title', `description` = '$description',`imagepath` ='$imagepath' WHERE `id` = '$id';";

	$con = new ConnectionDB();
	$api = new Api($con);
	$result = $api->ExecuteQuery($qry);
}
echo "failed";
exit();
?>
