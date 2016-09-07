<?php
require_once("../api.php");


     if(isset($_FILES['file']) && isset($_POST['name']) && isset($_POST['position']) && isset($_POST['description'])) {

 	$validate = new ValidateUploadPicture("../assets/img/aboutus/ourteam/"); //constructor injection - string
 	$res = $validate->Validate($_FILES['file']);   //method injection - array
 	$res = json_decode($res);  //return stdClass

     if($res->data=="success"){

            $temporary = explode(".", $_FILES["file"]["name"]);
            $file_extension = end($temporary);


           $name = $_POST['name'];
           $position =$_POST['position'];
           $description = $_POST['description'];


           $arr = array('name' => $name,
                        'position'=>$position,
                        'description'=>$description );

           $validate = new Validation();
           $validate->Validate($arr);

           $imagepath = "../assets/img/aboutus/ourteam/".$_POST['name'].$_POST['position'].".".$file_extension;
           $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
           $targetPath =  $imagepath; // Target path where file is to be stored

           move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file

           $qry ="INSERT INTO `tblourteam`(`name`,`position`,`description`,`imagepath`)VALUES('$name','$position','$description','$imagepath')";

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
