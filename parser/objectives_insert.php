<?php
require_once("./api.php");


     if(isset($_POST['serviceid']) && isset($_POST['objective'])) {

       $serviceid =  $_POST['serviceid'];
       $objective =  $_POST['objective'];



       $arr = array('serviceid' => $serviceid,
                 'objective'=>$objective);

       $validate = new Validation();
       $validate->Validate($arr);

       $qry ="INSERT INTO `tblobjectives`(`serviceid`,`objective`) VALUES('$serviceid','$objective')";

       $con = new ConnectionDB();
       $api = new Api($con);
       $res =  $api->ExecuteNonQuery($qry);
       echo $res;
       exit();
     }

    echo "failed";
    exit();

?>
