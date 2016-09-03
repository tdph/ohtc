<?php
require_once("./api.php");

$append=';';

if(isset($_POST['id'])) {
   $id = $_POST['id'];
   $arr = array('id' => $id);
   $validate = new Validation();
   $validate->Validate($arr);
   $append = " WHERE `id`=".$id.";";
}
$qry = "DELETE FROM tblmodule".$append;

$con = new ConnectionDB();
$api = new Api($con);
$res =  $api->ExecuteNonQuery($qry);
echo $res;
exit();

?>
