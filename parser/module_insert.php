<?php
require_once("./api.php");


     if(isset($_POST['description']) && isset($_POST['serviceid'])) {

       $description = $_POST['description'];
       $serviceid =$_POST['serviceid'];

       $arr = array('description'=>$description,
                'serviceid'=>$serviceid);

       $validate = new Validation();
       $validate->Validate($arr);

       $qry ="INSERT INTO `tblmodule`( `serviceid`,`description`)VALUES('$serviceid','$description')";

       $con = new ConnectionDB();
       $api = new Api($con);
       $api->ExecuteQuery($qry);
     }
    echo "failed";
    exit();

?>
