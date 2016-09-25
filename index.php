<?php
     include('inc/header.php');
 ?>
<div id="home-carousel" class="carousel slide" data-ride="carousel">
    <?php
    $dir = "assets/img/home/carousel/";
    $filenameArray = array();
    $handle = opendir($dir);
    while($file = readdir($handle)) {
        if($file !== '.' && $file !== '..'){
            $filenameArray[] = $dir.$file;
        }
    }
    ?>
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php
            foreach ($filenameArray as $key => $value) {
                $append = ($key==0)?'class="active"':'';
                echo '<li data-target="#home-carousel" data-slide-to="'.$key.'" '.$append.'></li>';
            }
        ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php
            foreach ($filenameArray as $key => $value) {
                $append = ($key==0)?'active':'';
                echo '<div class="item '.$append.'">
                    <img src="'.$value.'" alt="..." />
                </div>';
            }
        ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#home-carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#home-carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="home-content-wrapper aboutus">
    <div class="c-sm-7 details dark">
        <h3>ABOUT US</h3>
        <h4>OHTC is one of the most advanced state of the art culinary and hospitality training center in the Philippines.</h4>
        <a href="aboutus.php">READ MORE</a>
    </div>
    <div class="c-sm-5 image"></div>
</div>
<div class="home-content-wrapper services">
    <div class="c-sm-7 details dark">
        <h3>SERVICES</h3>
        <h4>We offer presently a wide selection of training programs. Examples include:</h4>
        <ul>
            <li>Culinary Skills Development for Chief Cooks</li>
            <li>Gallery Administration</li>
            <li>Bread and Pastry Production</li>
            <li>Food Safety &amp; Hygiene</li>
            <li>Healthy Cooking at Sea and Nutritional Education</li>
        </ul>
        <a href="services.php">READ MORE</a>
    </div>
    <div class="c-sm-5 image"></div>
</div>
<div class="home-content-wrapper news">
    <div class="c-sm-7 details">
        <h3>IN THE NEWS</h3>
        <?php
        require_once("api.php");
        $con = new ConnectionDB();
        $api = new Api($con);
        $qry = "SELECT `id`,`title`,`content`,`dateadded`,`imagepath`,`isfeatured` FROM `tblnews` WHERE `isfeatured`=1";
        $result = $api->ExecuteReader($qry);
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $imgsrc = $row['imagepath'];
        $content = $row['content'];
        $date = new DateTime($row['dateadded']);
        $date = $date->format('Y-m-d');
        if(strlen($content) > 200) { $content = substr($content, 0, 185)."..."; }
        ?>
        <h4><?php echo $title; ?></h4>
        <p><?php echo $content; ?></p>
        <a href="news.php">READ MORE</a>
    </div>
    <!-- <img src="<?php //echo $imgsrc; ?>" /> IMAGE-->
    <div class="c-sm-5 image" style="background-image: url(<?php echo $imgsrc; ?>)"></div>
</div>
<div class="video-wrapper">
    <div class="flex-video-wrap">
        <div class="flex-video">
            <iframe src="https://www.youtube.com/embed/fzoIPLY3ESg?rel=0&controls=0&showinfo=0" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>
<?php include('inc/footer.php'); ?>
