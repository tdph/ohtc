<?php
require_once("../api.php");

if(isset($_FILES["uploadServices"]["type"]))
{


    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["uploadServices"]["name"]);
    $file_extension = end($temporary);

    if ((($_FILES["uploadServices"]["type"] == "image/png") || ($_FILES["uploadServices"]["type"] == "image/jpg") || ($_FILES["uploadServices"]["type"] == "image/jpeg")
    ) && ($_FILES["uploadServices"]["size"] < 5000000)//Approx. 5mb files can be uploaded.
    && in_array($file_extension, $validextensions)) {
        if ($_FILES["uploadServices"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["uploadServices"]["error"] . "<br/><br/>";
        }
        else
        {
            if (file_exists(Vars::$services . $_FILES["uploadServices"]["name"])) {
                echo $_FILES["uploadServices"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
            }
            else
            {

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
                $api->ExecuteQuery($qry)
            }
        }
    }
    else
    {
        echo "<span id='invalid'>***Invalid file Size or Type***<span>";
    }
}
?>
