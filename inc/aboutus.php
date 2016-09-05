<div class="admin-header dark">
    <h3><span class="btn-back glyphicon glyphicon-chevron-left"></span> ABOUT US</h3>
</div>
<div class="admin-aboutus">
    <h3>Our Team</h3>
    <div class="hidden"><input type="file" id="upload-team" name="upload-team"></div>
    <button type="button" id="btn-browse-team" name="btn-browse-team">BROWSE</button>
    <button type="button" id="btn-upload-team" name="btn-upload-team">UPLOAD</button>
    <progress id='progressorteam' value="0" max='100' style=""></progress>
</div>


<div class="admin-aboutus">
    <h3>Our Facilities</h3>
    <form class="facility-form" onsubmit="return false;">
        <div class="hidden"><input type="file" id="upload-facility" name="upload-facility"></div>
        <button type="button" id="btn-browse-facility" name="btn-browse-facility">BROWSE</button>
        <input type="text" id="facility-name" name="name" value="" placeholder="Name...">
        <button type="button" id="btn-upload-facility" name="btn-upload-facility">UPLOAD</button>
        <progress id='progressorfacility' value="0" max='100' style=""></progress>
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
