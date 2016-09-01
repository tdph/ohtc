<?php
require_once("./api.php");
     if(isset($_POST['name']) && isset($_POST['position']) && isset($_POST['description']) && isset($_POST['imagepath']) && issset($_POST['id'])) {

            $name = $_POST['name'];
            $position = $_POST['position'];
            $description = $_POST['description'];
            $imagepath = $_POST['imagepath'];
            $id = $_POST['id'];

            $arr = array('name' => $name,
                      'position'=>$position,
                      'description'=>$description,
                  'imagepath'=>$imagepath,
                'id'=>$id);

           $validate = new Validation();
           $validate->Validate($arr);

           $qry ="UPDATE `tblourteam` SET `name` = '$name',`position` = '$position', `description` = '$description',`imagepath` = '$imagepath' WHERE `id` ='$id'; ";

           $con = new ConnectionDB();
           $api = new Api($con);
           $api->ExecuteQuery($qry);
     }
?>
