<?php
require_once("../api.php");

if(isset($_FILES['file']) && isset($_POST['title']) && isset($_POST['description']) ) {


			$validate = new ValidateUploadPicture("../assets/img/gallery/"); //constructor injection - string
			$res = $validate->Validate($_FILES['file']);   //method injection - array
			$res = json_decode($res);  //return stdClass

			if($res->data=="success"){

						$title =    $_POST['title'];
						$description =  $_POST['description'];

						$arr = array('title' => $title,
									 'description' => $description);

						$validate = new Validation();
						$validate->Validate($arr);

						$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
						$targetPath =   "../assets/img/gallery/".$_FILES['file']['name']; // Target path where file is to be stored
						move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file

						$qry ="INSERT INTO `tblgallery`(`title`,`description`,`imagepath`)VALUES('".filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES)."','".filter_var($description, FILTER_SANITIZE_MAGIC_QUOTES)."','$targetPath');";

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
