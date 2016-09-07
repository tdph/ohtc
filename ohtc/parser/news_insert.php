<?php
require_once("./api.php");

if(isset($_POST['title']) && isset($_POST['content'])) {
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
echo "failed";
exit();
?>
