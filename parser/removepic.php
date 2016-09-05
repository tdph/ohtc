<?php

    require_once("../api.php");

    if(isset($_POST['file'])){
        $validate = new Validation();
        $validate->Validate(array("pathfile"=>$_POST['file']));

          $path = realpath($_POST['file']);
          if(is_writable($path)){

              unlink($path);
              echo json_encode(array("status"=>"success","data"=>"success"));
              exit();
           }
          else {   echo json_encode(array("status"=>"failed","data"=>"file is not writable can't delete")); exit(); }
    }
    echo json_encode(array("status"=>"failed","data"=>"failed")); exit();
?>
