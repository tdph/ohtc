<?php

require_once("../api.php");

$append = (isset($_POST['id']) ? " WHERE `id`=".$_POST['id'].";" : ";");
$qry = "SELECT `id`,`name`,`position`,`description`,`imagepath`,`dateadded` FROM `tblourteam`".$append;

$con = new ConnectionDB();
$api = new Api($con);
$result = $api->ExecuteReader($qry);

$arr = array();
while($row = mysqli_fetch_row($result)) {
    $arr[] = array("id"=>$row[0],"name"=>$row[1],"position"=>$row[2],"description"=>$row[3],"imagepath"=>$row[4],"dateadded"=>$row[5]);
}
echo json_encode($arr);

?>
