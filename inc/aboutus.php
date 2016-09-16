<div class="admin-header dark">
    <h3><span class="btn-back glyphicon glyphicon-chevron-left"></span> ABOUT US</h3>
</div>
<div class="admin-aboutus">
    <h3>Our Team</h3>
    <div class="hidden"><input type="file" id="upload-team" name="upload-team"></div>
    <button type="button" id="btn-browse-team" name="btn-browse-team">BROWSE</button>
    <input type="text" id="team-name" name="team-name"  placeholder="Name..."/>
    <input type="text" id="team-position" name="team-position"  placeholder="Position..."/>
    <input type="text" id="team-description" name="team-description"  placeholder="Description..."/>

    <button type="button" id="btn-upload-team" name="btn-upload-team">UPLOAD</button>
    <div class="progress">
        <div id="progressorteam" class="active progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
        </div>
    </div>
    <div>
      <?php

      require_once("api.php");
      $qry = "SELECT `id`,`name`,`position`,`description`,`imagepath`,`dateadded` FROM `tblourteam`;";
      $con = new ConnectionDB();
      $api = new Api($con);
      $result = $api->ExecuteReader($qry);
      $c = 0;
      $cnt = 0;
      while($row = mysqli_fetch_assoc($result)) {
          $cnt++;
          if($c == 0) { ?> <div class="ourteam_wrapper"> <?php } ?>
          <div class="image_wrapper c-sm-6 c-md-3" id="<?php echo $row['id']; ?>">
              <span data-id="<?php echo $row["id"]; ?>" class="btn-remove-ourteam glyphicon glyphicon-remove" style="cursor:pointer;"></span>
              <img  id="ourteam<?php echo $row['id']; ?>" src="<?php  echo substr($row['imagepath'],3);  ?>" border="0" />
              <span clas="label-default">Name: <?php  echo $row["name"]; ?></span>
              <span clas="label-default">Position: <?php echo $row["position"]; ?></span>
              <span clas="label-default">Description: <?php echo  $row["description"]; ?></span>
          </div>
          <?php $c++;
          if($c == 4 || $cnt == mysqli_num_rows($result)) { $c = 0; ?></div><?php }
      }
      ?>
    </div>
</div>


<div class="admin-aboutus">
    <h3>Our Facilities</h3>
    <form class="facility-form" onsubmit="return false;">
        <div class="hidden"><input type="file" id="upload-facility" name="upload-facility"></div>
        <button type="button" id="btn-browse-facility" name="btn-browse-facility">BROWSE</button>
        <input type="text" id="facility-name" name="name" value="" placeholder="Name...">
        <button type="button" id="btn-upload-facility" name="btn-upload-facility">UPLOAD</button>
        <div class="progress">
            <div id="progressorfacility" class="active progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
            </div>
        </div>
    </form>
    <div class="facility-wrapper">
    <?php
        $facilitydir = "assets/img/aboutus/ourfacilities/";
        $handle = opendir($facilitydir);
        $id = 0;
        while($file = readdir($handle)) {
            $id++;
            if($file !== '.' && $file !== '..') {
                echo '<div class="c-xs-6 c-sm-4 c-md-3 image-wrapper">'.
                '<span data-id="falicity'.$id.'" class="btn-remove-facility glyphicon glyphicon-remove"></span>'.
                '<img id="falicity'.$id.'" src="'.$facilitydir.$file.'" border="0" />'.
                '<div class="image-title">'.substr($file, 0, strrpos($file, ".")).'</div></div>';
            }
        }
    ?>
    </div>
</div>
