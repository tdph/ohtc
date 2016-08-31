<?php
require_once("./api.php");

     if(isset($_POST['name']) &&  isset($_POST['description']) && isset($_POST['imagepath'])
     && isset($_POST['minstudents'])
    && isset($_POST['maxstudents'])
    && isset($_POST['duration'])
      && isset($_POST['id']) ) {

            $name =  $_POST['name'];
            $description =  $_POST['description'];
            $minstudents =   $_POST['minstudents'];
            $maxstudents =  $_POST['maxstudents'];
            $duration =  $_POST['duration'];
            $imagepath =  $_POST['imagepath'];
            $id =  $_POST['id'];

            $arr = array('name' => $name,
                      'description'=>$description,
                `minstudents`=>$minstudents,
                `maxstudents`=>$maxstudents,
                `duraration`=>$duration,
            'imagepath'=>$imagepath,
            'id'=>$id);

           $validate = new Validation();
           $validate->Validate($arr);

           $qry ="UPDATE `tblservices` SET `name` = '$name',`description` = '$description',`minstudents` = '$minstudents',`maxstudents` = '$maxstudents',`duration` = '$duration', `imagepath` = '$imagepath' WHERE `id` = '$id'; ";
           $con = new ConnectionDB();
           $api = new Api($con);
           $api->ExecuteQuery($qry);
      }
?>
