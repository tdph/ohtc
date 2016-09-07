<?php

    require_once("../api.php");

    if(isset($_FILES['file']) && isset($_POST['fixedwidth']) && isset($_POST['fixedheight']) && isset($_POST['type']) && isset($_POST['newname'])){

        $arr = array("carousel"=>"../assets/img/home/carousel/",
                     "team"=>"../assets/img/aboutus/ourteam/",
                    "facility"=>"../assets/img/aboutus/ourfacilities/");

        $temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);
        $_FILES['file']['name'] = (($_POST['newname']=="")? $_FILES['file']['name']:$_POST['newname'].".".$file_extension);

        $validate = new ValidateUploadPicture($arr[$_POST['type']]); //pass the directory where the picture will be saved
        $res = $validate->Validate($_FILES['file']);  //validate the picture
        $res = json_decode($res);

        if($res->data=="success"){

           $validate = new ValidatePictureDimension($_POST['fixedwidth'],$_POST['fixedheight']);
           $res = $validate->Validate($_FILES['file']);
           $res = json_decode($res);

           if($res->data=="success"){

               $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
               $targetPath =  $arr[$_POST['type']].$_FILES['file']['name']; // Target path where file is to be stored
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
