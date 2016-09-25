<?php
		require_once("../api.php");
		if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['id'])) {

				$title = $_POST['title'];
				$content = $_POST['content'];
				$dateadded = $_POST['date'];
				$id = $_POST['id'];
				$markasfeautured = $_POST['markasfeautured'];

				$arr = array('title' => $title,
					'content'=>$content,
					'dateadd'=>$dateadded,
					'id'=>$id,
				   'markasfeautured'=>$markasfeautured);

				$validate = new Validation();
				$validate->Validate($arr);

				if(isset($_POST['pictureupdate']) && $_POST['pictureupdate']==true && isset($_FILES['file'])){

						$validate = new ValidateUploadPicture("../assets/img/news/"); //constructor injection - string
						$res = $validate->Validate($_FILES['file']);   //method injection - array
						$res = json_decode($res);  //return stdClass

						if($res->data=="success"){}
						else{ echo json_encode(array("status"=>$res->status,"data"=>$res->data)); exit(); }

						$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
						$targetPath =  "../assets/img/news/".$_FILES['file']['name']; // Target path where file is to be stored
						move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file

				}
				$dateadded = $dateadded." 00:00:00";

				$validate = new Validation();
				$validate->Validate($arr);

				$content = filter_var($content, FILTER_SANITIZE_MAGIC_QUOTES);
				$title = filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES);

				$con = new ConnectionDB();
				$api = new Api($con);

				if(intval($markasfeautured)==1){
					$qry = "UPDATE `tblnews` SET `isfeatured`='0' WHERE `id`>0";
					$api->ExecuteNonQuery($qry);
				}

				$qry ="UPDATE tblnews SET `title`='$title', `content`='$content',`dateadded`='$dateadded',`isfeatured`='$markasfeautured' WHERE `id`='$id';";


				$res =  $api->ExecuteNonQuery($qry);
				echo $res;
				exit();

		}
		echo json_encode(array("status"=>"failed","data"=>"failed"));
		exit();
?>
