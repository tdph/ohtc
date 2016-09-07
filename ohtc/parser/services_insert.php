
<?php
    require_once("../api.php");


    if(isset($_FILES['uploadServices'])){

        $validate = new ValidateUploadPicture("../".Vars::$services); //constructor injection - string
        $res = $validate->Validate($_FILES['uploadServices']);   //method injection - array
        $res = json_decode($res);  //return stdClass

        if($res->data=="success"){

              $modules = $_POST['modules'];
              $objectives = $_POST['objectives'];

              $modules = explode(",",$modules);
              $objectives = explode(",",$objectives);

              $title = $_POST['title'];
              $description = $_POST['description'];
              $minstudent = $_POST['minstudent'];
              $maxstudent = $_POST['maxstudent'];
              $duration = $_POST['duration'];

              $arr = array('title'=>$title,
              'description'=>$description,
              'minstudent'=>$minstudent,
              'maxstudent'=>$maxstudent,
              'duration'=>$duration);

              $validate = new Validation();
              $validate->Validate($arr);

              $sourcePath = $_FILES['uploadServices']['tmp_name']; // Storing source path of the file in a variable
              $targetPath =  "../".Vars::$services.$_FILES['uploadServices']['name']; // Target path where file is to be stored
              move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file

              $qry ="INSERT INTO `tblservices`(`name`,`description`,`minstudents`,`maxstudents`,`duration`,`imagepath`) VALUES('$title','$description','$minstudent','$maxstudent','$duration','$targetPath')";

              $con = new ConnectionDB();
              $api = new Api($con);
              $api->ExecuteNonQuery($qry);
              $id = $api->ExecuteLastInsertId();

              foreach ($modules as $key => $value) {
                   $qry = "INSERT INTO `tblmodule`(`serviceid`,`description`)VALUES('$id','$value')";
                   $api->ExecuteNonQuery($qry);
              }

              foreach ($objectives as $key => $value) {
                   $qry = "INSERT INTO `tblobjectives`(`serviceid`,`objective`)VALUES('$id','$value')";
                   $api->ExecuteNonQuery($qry);
              }
              echo json_encode(array("status"=>"success","data"=>"success"));
              exit();
        }
        echo json_encode(array("status"=>$res->status,"data"=>$res->data));
        exit();
    }
    echo json_encode(array("status"=>"failed","data"=>"failed"));
    exit();
?>
