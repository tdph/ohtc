<?php
if(isset($_GET['dir'])) {
    $dir = $_GET['dir'];
    $filenameArray = array();
    $handle = opendir("../$dir");
    while($file = readdir($handle)) {
        if($file !== '.' && $file !== '..'){
            array_push($filenameArray, $file);
        }
    }
    echo json_encode($filenameArray);
}
?>
