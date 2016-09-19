<div class="admin-header dark">
    <h3><span class="btn-back glyphicon glyphicon-chevron-left"></span> GALLERY</h3>
</div>
<div class="admin-gallery">
    <h3>Gallery</h3>
    <div class="hidden"><input type="file" id="upload-gallery" name="upload-gallery"></div>
    <button type="button" id="btn-browse-gallery" name="btn-browse-gallery">BROWSE</button>
    <input type="text" id="gallery-title" name="gallery-title"  placeholder="Title..."/>
    <input type="text" id="gallery-description" name="gallery-description"  placeholder="Description..."/>

    <button type="button" id="btn-upload-gallery" name="btn-upload-gallery">UPLOAD</button>
    <div class="progress">
        <div id="progressorgallery" class="active progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
        </div>
    </div>
    <div id="gallery_container-admin">
        <?php
        require_once("api.php");
        $qry = "SELECT `id`,`title`,`description`,`imagepath`,`dateadded` FROM tblgallery";
        $con = new ConnectionDB();
        $api = new Api($con);
        $result = $api->ExecuteReader($qry);
        $c = 0;
        $cnt = 0;
        while($row = mysqli_fetch_row($result)) {
            $cnt++;
            if($c == 0) { ?> <div class="gallery_wrapper"> <?php } ?>
            <div class="image_wrapper c-sm-6 c-md-3">
                <span data-id="<?php echo $row[0]; ?>" class="btn-remove-gallery glyphicon glyphicon-remove"></span>
                <img id="gallery<?php echo $row[0]; ?>" src="<?php echo $row[3]; ?>" />
            </div>
            <?php $c++;
            if($c == 4 || $cnt == mysqli_num_rows($result)) { $c = 0; ?></div><?php }
        }
        ?>
    </div>
</div>
