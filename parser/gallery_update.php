<?php
		require_once("../api.php");

		if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['id'])) {

				$append='';
				$title =   $_POST['title'];
				$description =   $_POST['description'];
				$id = $_POST['id'];

				$arr = array('title' => $title,
							 'description' => $description,
							 'id'=>$id);

				$validate = new Validation();
				$validate->Validate($arr);

				if(isset($_POST['pictureupdate']) && $_POST['pictureupdate']==true && isset($_FILES['file'])){

							$validate = new ValidateUploadPicture("../assets/img/gallery/"); //constructor injection - string
							$res = $validate->Validate($_FILES['file']);   //method injection - array
							$res = json_decode($res);  //return stdClass

							if($res->data=="success"){}
							else { echo json_encode(array("status"=>$res->status,"data"=>$res->data)); exit();}

							$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
							$targetPath =   "../assets/img/gallery/".$_FILES['file']['name']; // Target path where file is to be stored
							//if(file_exists($targetPath)){ unlink($targetPath);  }
							move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file
							$append = ",`imagepath`='".$targetPath."'";
				}
				
				$title = filter_var($content, FILTER_SANITIZE_MAGIC_QUOTES);
				$description = filter_var($description, FILTER_SANITIZE_MAGIC_QUOTES);

				$qry ="UPDATE `tblgallery` SET `title` = '$title', `description` = '$description' $append  WHERE `id` = '$id';";

				$con = new ConnectionDB();
				$api = new Api($con);
				$res =  $api->ExecuteNonQuery($qry);
				echo $res;
				exit();
		}
		echo json_encode(array("status"=>"failed","data"=>"failed"));
		exit();
?>
