<?php

    require_once("../api.php");

    if(isset($_FILES['file'])){

        $validate = new ValidateUploadPicture("../assets/img/home/carousel/"); //constructor injection - string
        $res = $validate->Validate($_FILES['file']);   //method injection - array
        $res = json_decode($res);

        if($res->data=="success"){

           $validate = new ValidatePictureDimension();
           $res = $validate->Validate($_FILES['file']);   //method injection - array
           $res = json_decode($res);

           if($res->data=="success"){

               $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
               $targetPath =  "../assets/img/home/carousel/".$_FILES['file']['name']; // Target path where file is to be stored
               move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file

               echo json_encode(array("status"=>"success","data"=>"success"));
               exit();
           }
           echo json_encode(array("status"=>$res->status,"data"=>$res->data));
           exit();
           
        }
        echo json_encode(array("status"=>$res->status,"data"=>$res->data));
        exit();

    }
    echo json_encode(array("status"=>"failed","data"=>"failed"));
    exit();

?>
