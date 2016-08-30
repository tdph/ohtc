<?php

    require_once("./api.php");

    $append = (isset($_POST['id']) ? " WHERE `id`=".$_POST['id'].";" : ";");
    $qry = "SELECT `id`,`serviceid`,`objective`,`dateadded` FROM `tblobjectives`".$append;

    $con = new ConnectionDB();
    $api = new Api($con);
    $result = $api->ExecuteReader($qry);

    $arr = array();
    while($row = mysqli_fetch_row($result)){
       $arr[] = $row;
    }
    echo json_encode($arr);

?>
