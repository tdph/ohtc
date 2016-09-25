<?php
require_once('inc/header.php');
$page = isset($_GET['page']) ? $_GET['page'] : "";
$pages = array("home", "aboutus", "services", "news", "gallery");
if(!in_array($page, $pages)) { $page = ""; }
if($page == "") { ?>
    <div class="admin-wrapper">
        <a href="?page=home"><p class="admin-pages">HOME</p></a>
        <a href="?page=aboutus"><p class="admin-pages">ABOUT US</p></a>
        <!-- <a href="?page=services"><p class="admin-pages">SERVICES</p></a> -->
        <a href="?page=news"><p class="admin-pages">NEWS</p></a>
        <a href="?page=gallery"><p class="admin-pages">GALLERY</p></a>
    </div>
<?php }
else { include("inc/$page.php"); }
require_once('inc/footer.php'); ?>
