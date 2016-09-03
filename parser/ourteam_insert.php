<?php
require_once("./api.php");


     if(isset($_POST['name']) && isset($_POST['position']) && isset($_POST['description']) && isset($_POST['imagepath'])) {

       $name = $_POST['name'];
       $position =$_POST['position'];
       $description = $_POST['description'];
       $imagepath =$_POST['imagepath'];

       $arr = array('name' => $name,
                    'position'=>$position,
                    'description'=>$description,
                'imagepath'=>$imagepath);

       $validate = new Validation();
       $validate->Validate($arr);

       $qry ="INSERT INTO `tblourteam`(`name`,`position`,`description`,`imagepath`)VALUES('$name','$position','$description','$imagepath')";

       $con = new ConnectionDB();
       $api = new Api($con);
       $res =  $api->ExecuteNonQuery($qry);
       echo $res;
       exit();
    }
    echo "failed";
    exit();

?>
