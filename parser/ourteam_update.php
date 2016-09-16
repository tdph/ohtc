<?php
require_once("../api.php");
     if(isset($_POST['name']) && isset($_POST['position']) && isset($_POST['description']) && isset($_FILES['file']) && isset($_POST['id'])) {


         $validate = new ValidateUploadPicture("../assets/img/aboutus/ourteam/"); //constructor injection - string
         $res = $validate->Validate($_FILES['file']);   //method injection - array
         $res = json_decode($res);  //return stdClass
         if($res->data=="success"){

              $temporary = explode(".", $_FILES["file"]["name"]);
              $file_extension = end($temporary);

              $name = $_POST['name'];
              $position = $_POST['position'];
              $description = $_POST['description'];
              $id = $_POST['id'];

              $arr = array('name' => $name,
                        'position'=>$position,
                        'description'=>$description,
                  'id'=>$id);

             $validate = new Validation();
             $validate->Validate($arr);

             $imagepath = "../assets/img/aboutus/ourteam/".trim($_POST['name']).trim($_POST['position']).".".$file_extension;
             $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
             $targetPath =  $imagepath; // Target path where file is to be stored

             if(file_exists($imagepath)){ unlink($imagepath);  echo json_encode(array("status"=>$sourcePath,"data"=>$imagepath));
              exit(); }

             move_uploaded_file($sourcePath,$sourcePath); // Moving Uploaded file

             $qry ="UPDATE `tblourteam` SET `name` = '$name',`position` = '$position', `description` = '$description',`imagepath` = '$imagepath' WHERE `id` ='$id'; ";

             $con = new ConnectionDB();
             $api = new Api($con);
             $res =  $api->ExecuteNonQuery($qry);
             echo $res;
             exit();
         }
         echo json_encode(array("status"=>$res->status,"data"=>$res->data));
         exit();
     }
     echo json_encode(array("status"=>"failed","data"=>"failed"));
     exit();

?>
