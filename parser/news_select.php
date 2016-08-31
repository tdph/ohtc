<?php
//default pagination 0-10 if limit x and y
require_once("./api.php");
$append = (isset($_POST['id']) ? " WHERE `id`=".$_POST['id'].";" : ";");
$qry = "SELECT `id`,`title`,`content`,`dateadded` FROM tblnews".$append;

$con = new ConnectionDB();
$api = new Api($con);
$result = $api->ExecuteReader($qry);

$arr = array();
while($row = mysqli_fetch_row($result)){
	$arr[] = $row;
}
echo json_encode($arr);
?>
