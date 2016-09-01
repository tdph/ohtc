<?php
require_once("./api.php");


    if(isset($_POST['name']) &&  isset($_POST['description']) && isset($_POST['imagepath'])
    && isset($_POST['minstudents'])
    && isset($_POST['maxstudents'])
    && isset($_POST['duration'])
      ) {

       $name =  $_POST['name'];
       $description =  $_POST['description'];
       $minstudents =   $_POST['minstudents'];
       $maxstudents =  $_POST['maxstudents'];
       $duration =  $_POST['duration'];
       $imagepath =  $_POST['imagepath'];


       $arr = array('name' => $name,
                 'description'=>$description,
           `minstudents`=>$minstudents,
           `maxstudents`=>$maxstudents,
           `duraration`=>$duration,
       'imagepath'=>$imagepath);

       $validate = new Validation();
       $validate->Validate($arr);

       $qry ="INSERT INTO `tblservices`(`name`,`description`,`minstudents`,`maxstudents`,`duration`,`imagepath`) VALUES('$name','$description','$minstudents','$maxstudents','$duration','$imagepath')";

       $con = new ConnectionDB();
       $api = new Api($con);
       $api->ExecuteQuery($qry);
    }
    
    echo "failed";
    exit();

?>
