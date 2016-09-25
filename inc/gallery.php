<?php
  require_once("api.php");
  $imgsrc='';
  $title='';
  $desc='';
  $id='';
  $btn = '<button type="button" id="btn-upload-gallery" name="btn-upload-gallery">UPLOAD</button>';
  if(isset($_GET['edit']) && isset($_GET['id'])){
      if($_GET['edit']=="gallery" && $_GET['id']!=''){

            $qry = "SELECT `id`,`title`,`description`,`imagepath`,`dateadded` FROM tblgallery WHERE `id`=".$_GET['id'].";";
            $con = new ConnectionDB();
            $api = new Api($con);
            $result = $api->ExecuteReader($qry);
            $row = mysqli_fetch_assoc($result);
            $imgsrc=substr($row['imagepath'],3);
            $title=$row["title"];
            $desc=$row["description"];
            $btn = '  <button type="button" id="btn-update-gallery" name="btn-update-gallery" value="'.$row['id'].'">UPDATE</button>
              <button type="button" id="btn-cancel-gallery" name="btn-cancel-gallery" value="'.$row['id'].'">CANCEL</button>';
      }
  }
?>
<div class="admin-header dark">
    <h3><span class="btn-back glyphicon glyphicon-chevron-left"></span> GALLERY</h3>
</div>
<div class="admin-gallery">
    <h3>Gallery</h3>

    <div class="hidden"><input type="file" id="upload-gallery" name="upload-gallery" onchange="readURL(this,'galleryimg')"></div>
    <img src="<?php echo $imgsrc; ?>" id="galleryimg" />
    <button type="button" id="btn-browse-gallery" name="btn-browse-gallery">BROWSE</button>
    <input type="text" id="gallery-title" name="gallery-title"  placeholder="Title..." value="<?php echo $title; ?>" />
    <input type="text" id="gallery-description" name="gallery-description"  placeholder="Description..." value="<?php echo $desc; ?>" />

    <?php echo $btn; ?>
    <div class="progress">
        <div id="progressorgallery" class="active progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
        </div>
    </div>
    <div id="gallery_container-admin">
        <?php

        $display = (isset($_GET['edit']) && isset($_GET['id']) && $_GET['edit']=="gallery" && $_GET['id']!='')?$_GET['id']:'';

        $qry = "SELECT `id`,`title`,`description`,`imagepath`,`dateadded` FROM tblgallery";
        $con = new ConnectionDB();
        $api = new Api($con);
        $result = $api->ExecuteReader($qry);
        $c = 0;
        $cnt = 0;
        while($row = mysqli_fetch_row($result)) {
            $cnt++;
            if($c == 0) { ?> <div class="gallery_wrapper"> <?php } ?>
            <?php
              if($display!=$row[0]){
            ?>
            <div class="image_wrapper c-sm-6 c-md-3">
                <img id="gallery<?php echo $row[0]; ?>" src="<?php echo $row[3]; ?>" />
                <button type="button"  id="galleryedit"  value="<?php echo $row[0]; ?>"  onclick="editGallery(<?php echo $row[0]; ?>)" >EDIT</button>
                <button type="button" data-id="<?php echo $row[0]; ?>" class="btn-remove-gallery">DELETE</button>
            </div>
            <?php  } ?>
            <?php $c++;
            if($c == 4 || $cnt == mysqli_num_rows($result)) { $c = 0; ?></div><?php }
        }
        ?>
    </div>
</div>
