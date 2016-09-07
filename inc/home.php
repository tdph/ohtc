<div class="admin-header dark">
    <h3><span class="btn-back glyphicon glyphicon-chevron-left"></span> HOME</h3>
</div>
<div class="admin-home">
    <h3>Carousel</h3>
    <div class="hidden"><input type="file" id="upload-carousel" name="upload-carousel"></div>
    <button type="button" id="btn-browse-carousel" name="btn-browse">BROWSE</button>
    <button type="button" id="btn-upload-carousel" name="btn-upload">UPLOAD</button>
    <div class="progress">
        <div id="progressor" class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
        </div>
    </div>
    <div class="carousel-wrapper">
    <?php
        $carouseldir = "assets/img/home/carousel/";
        $handle = opendir($carouseldir);
        $id = 0;
        while($file = readdir($handle)) {
            $id++;
            if($file !== '.' && $file !== '..') {
                echo '<div class="c-xs-6 c-sm-4 c-md-3 image-wrapper"><span data-id="carousel'.$id.'" class="btn-remove-carousel glyphicon glyphicon-remove"></span><img id="carousel'.$id.'" src="'.$carouseldir.$file.'" border="0" /></div>';
            }
        }
    ?>
    </div>
</div>
