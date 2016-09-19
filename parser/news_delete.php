<?php
			require_once("../api.php");

			$append=';';
			if(isset($_POST['id'])) {
				$id = $_POST['id'];
				$arr = array('id' => $id);
				$validate = new Validation();
				$validate->Validate($arr);
				$append = " WHERE `id`=".$id.";";
		    $img = isset($_POST['imgsrc']) ? $_POST['imgsrc'] : "";
			}
			$qry = "DELETE FROM tblnews".$append;

			$con = new ConnectionDB();
			$api = new Api($con);
			$res =  $api->ExecuteNonQuery($qry);
			if(file_exists($img)) { unlink($img);   }
			echo $res;
			exit();
?>
