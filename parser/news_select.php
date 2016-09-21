<?php

	require_once("../api.php");

	$append = ';'; //(isset($_POST['id']) ? " WHERE `id`=".$_POST['id'].";" : ";");
	if(isset($_POST['page']) && isset($_POST['limit'])) {
		$arr = array('page' => $_POST['page'],'limit'=>$_POST['limit']);
		$var = new Limit($arr);
		$append = $var->Append();
	}
	$qry = "SELECT `id`,`title`,`content`,`dateadded`,`imagepath` FROM tblnews ORDER BY `dateadded` DESC ".$append;
	$con = new ConnectionDB();
	$api = new Api($con);
	$result = $api->ExecuteReader($qry);
	$arr = array();
	while($row = mysqli_fetch_row($result)){
		$now = new DateTime($row[3]);
		$arr[] = array("id"=>$row[0],"title"=>$row[1],"content"=>$row[2],"dateadded"=>$now->format('jS F Y'),"imagepath"=>$row[4]);
	}
	echo json_encode($arr);
?>
