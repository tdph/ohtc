<?php

    require_once("./api.php");

    $append = ';'; //(isset($_POST['id']) ? " WHERE `id`=".$_POST['id'].";" : ";");

    if(isset($_POST['page']) && isset($_POST['limit'])){

    	$arr = array('page' => $arr['page'],'limit'=>$arr['limit']);
      $var = new Limit($arr);
    	$append = $var->Append();

    }

    $qry = "SELECT `id`,`name`,`description`,`minstudents`,`maxstudents`,`duration`,`imagepath`,`dateadded` FROM `tblservices`".$append;

    $con = new ConnectionDB();
    $api = new Api($con);
    $result = $api->ExecuteReader($qry);

    $arr = array();
    while($row = mysqli_fetch_row($result)){
       $arr[] = $row;
    }
    echo json_encode($arr);

?>
