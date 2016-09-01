<?php
require_once("./api.php");
     if(isset($_POST['description']) && isset($_POST['serviceid']) && isset($_POST['id'])) {

            $serviceid = $_POST['serviceid'];
            $description = $_POST['description'];
            $id = $_POST['id'];

            $arr = array('serviceid' => $serviceid,
                      'description'=>$description,
                      'id'=>$id );

           $validate = new Validation();
           $validate->Validate($arr);

           $qry ="UPDATE `tblmodule` SET `serviceid` = '$serviceid', `description` = '$description'  WHERE `id` ='$id'; ";
          // echo $qry;
           $con = new ConnectionDB();
           $api = new Api($con);
           $api->ExecuteQuery($qry);
     }
?>
