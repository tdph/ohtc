<?php
require_once("./api.php");

         if(isset($_POST['serviceid']) && isset($_POST['objective']) && isset($_POST['id'])) {

          $serviceid =  $_POST['serviceid'];
          $objective = $_POST['objective'];
          $id = $_POST['id'];

          $arr = array('serviceid' => $serviceid,
                    'objective'=>$objective,
                    'id'=>$id);

          $validate = new Validation();
          $validate->Validate($arr);

           $qry =" UPDATE `tblobjectives` SET `serviceid`='$serviceid',`objective` = '$objective' WHERE `id`='$id'";
           $con = new ConnectionDB();
           $api = new Api($con);
           $res =  $api->ExecuteNonQuery($qry);
           echo $res;
           exit();
       }
?>
