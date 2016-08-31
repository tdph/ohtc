<?php
require_once("./api.php");
if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['id'])) {
	$title = $_POST['title'];
	$content = $_POST['content'];
	$id = $_POST['id'];
	
	$arr = array('title' => $title, 
				 'content'=>$content, 
				 'id'=>$id);

	$validate = new Validation();
	$validate->Validate($arr);

	$qry ="UPDATE tblnews SET `title`='$title', `content`='$content' WHERE `id`='$id';";

	$con = new ConnectionDB();
	$api = new Api($con);
	$api->ExecuteQuery($qry);
}
?>
