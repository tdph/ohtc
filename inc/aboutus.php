<?php
  require_once("api.php");
  $imgsrc='';
  $name='';
  $pos='';
  $desc='';
  $id='';
  $btn = '<button type="button" id="btn-upload-team" name="btn-upload-team" >UPLOAD</button>';
  if(isset($_GET['edit']) && isset($_GET['id'])){
      if($_GET['edit']=="ourteam" && $_GET['id']!=''){

            $qry = "SELECT `id`,`name`,`position`,`description`,`imagepath`,`dateadded` FROM `tblourteam` WHERE  `id`=".$_GET['id']." limit 0,1;";
            $con = new ConnectionDB();
            $api = new Api($con);
            $result = $api->ExecuteReader($qry);
            $row = mysqli_fetch_assoc($result);
            $imgsrc=substr($row['imagepath'],3);
            $name=$row["name"];
            $pos=$row["position"];
            $desc=$row["description"];
            $btn = '  <button type="button" id="btn-update-team" name="btn-update-team" value="'.$row['id'].'">UPDATE</button>
              <button type="button" id="btn-cancel-team" name="btn-cancel-team" value="'.$row['id'].'">CANCEL</button>';
      }
  }
?>
<div class="admin-header dark">
    <h3><span class="btn-back glyphicon glyphicon-chevron-left"></span> ABOUT US</h3>
</div>

<div class="admin-aboutus">
    <h3>Our Team</h3>
    <div class="hidden"><input type="file" id="upload-team" name="upload-team" onchange="readURL(this,'imgteam')"></div>
    <img src="<?php echo $imgsrc; ?>" id="imgteam" />
    <button type="button" id="btn-browse-team" name="btn-browse-team">BROWSE</button>
    <input type="text" id="team-name" name="team-name"  placeholder="Name..." value="<?php echo $name; ?>"/>
    <input type="text" id="team-position" name="team-position"  placeholder="Position..." value="<?php echo $pos; ?> "/>
    <textarea id="team-description" name="team-description" placeholder="Description..."><?php echo $desc; ?></textarea>
    <?php echo $btn; ?>
    <div class="progress">
        <div id="progressorteam" class="active progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
        </div>
    </div><?php
    $display = (isset($_GET['edit']) && isset($_GET['id']) && $_GET['edit']=="ourteam" && $_GET['id']!='')?$_GET['id']:'';
    $qry = "SELECT `id`,`name`,`position`,`description`,`imagepath`,`dateadded` FROM `tblourteam`;";
    $con = new ConnectionDB();
    $api = new Api($con);
    $result = $api->ExecuteReader($qry);
    $c = 0;
    $cnt = 0;
    while($row = mysqli_fetch_assoc($result)) {
        $cnt++;
        if($c == 0) { ?> <div class="ourteam_wrapper"> <?php }
        if($display!=$row['id']) { ?>
        <div class="image-wrapper c-sm-6 c-md-3" id="<?php echo $row['id']; ?>">
            <img  id="ourteam<?php echo $row['id']; ?>" src="<?php  echo substr($row['imagepath'],3);  ?>" border="0" />
            <p clas="label-default" id="<?php echo $row['id']; ?>name"><?php  echo $row["name"]; ?></p>
            <p clas="label-default" id="<?php echo $row['id']; ?>position"><?php echo $row["position"]; ?></p>
            <button type="button" id="btn_ourteam_edit" value="<?php echo $row['id']; ?>" onclick="edit(<?php echo $row['id']; ?>)">EDIT</button>
            <button type="button" data-id="<?php echo $row["id"]; ?>"  class="btn-remove-ourteam">DELETE</button>
        </div>
      <?php }
      $c++;
      if($c == 4 || $cnt == mysqli_num_rows($result)) { $c = 0; ?></div><?php }
    }?>
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
