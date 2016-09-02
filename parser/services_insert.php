<?php
require_once("../api.php");

if(isset($_FILES["uploadServices"]["type"]))
{
      $validextensions = array("jpeg", "jpg", "png","JPG","JPEG","PNG");
      $temporary = explode(".", $_FILES["uploadServices"]["name"]);
      $file_extension = end($temporary);



      if ((($_FILES["uploadServices"]["type"] == "image/png") ||
           ($_FILES["uploadServices"]["type"] == "image/jpg") ||
           ($_FILES["uploadServices"]["type"] == "image/jpeg"))
           && ($_FILES["uploadServices"]["size"] < 5000000)  //Approx. 5mb files can be uploaded.
           && in_array($file_extension, $validextensions) ) {

            if ($_FILES["uploadServices"]["error"] > 0)
            {
                echo json_encode(array("status"=>"failed","data"=>$_FILES["uploadServices"]["error"] ));
                exit();

            }
            else
            {
                  if (file_exists(Vars::$services . $_FILES["uploadServices"]["name"])){

                     echo json_encode(array("status"=>"failed","data"=>$_FILES["uploadServices"]["name"]." already exists." ));
                     exit();

                  }
                  else
                  {
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
                      move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file

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
            }
       }
       else
       {
           echo json_encode(array("status"=>"failed","data"=>"***Invalid file Size or Type***" ));
           exit();

       }
}
else { echo json_encode(array("status"=>"failed","data"=>"no picture selected"));
exit(); }

?>
