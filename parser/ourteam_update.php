<?php
require_once("../api.php");

     if(isset($_POST['name']) && isset($_POST['position']) && isset($_POST['description']) && isset($_POST['id'])) {

        $append = '';
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

         if(isset($_POST['pictureupdate']) && $_POST['pictureupdate']==true && isset($_FILES['file'])){


               $validate = new ValidateUploadPicture("../assets/img/aboutus/ourteam/"); //constructor injection - string
               $res = $validate->Validate($_FILES['file']);   //method injection - array
               $res = json_decode($res);  //return stdClass

               if($res->data=="success"){ }
               else { echo json_encode(array("status"=>$res->status,"data"=>$res->data)); exit(); }

               $temporary = explode(".", $_FILES["file"]["name"]);
               $file_extension = end($temporary);

               $imagepath = "../assets/img/aboutus/ourteam/".trim($_POST['name']).trim($_POST['position']).".".$file_extension;
               $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
               $targetPath =  $imagepath; // Target path where file is to be stored

               if(file_exists($imagepath)){ unlink($imagepath);  }
               move_uploaded_file($sourcePath,$sourcePath); // Moving Uploaded file
               $append =",`imagepath` = '$imagepath' ";
        }

        $qry ="UPDATE `tblourteam` SET `name` = '$name',`position` = '$position', `description` = '$description' $append WHERE `id` ='$id'; ";

        $con = new ConnectionDB();
        $api = new Api($con);
        $res =  $api->ExecuteNonQuery($qry);
        echo $res;
        exit();

     }
     echo json_encode(array("status"=>"failed","data"=>"failed"));
     exit();

?>
