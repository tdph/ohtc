<div class="admin-header dark">
    <h3><span class="btn-back glyphicon glyphicon-chevron-left"></span> SERVICES</h3>
</div>
<div class="admin-services">
    <form id="form_services" method="post" enctype="multipart/form-data">
      <input type="text" placeholder="Title..." name="title"/>
      <textarea  placeholder="Description..." name="description"/></textarea>
      <input type="number" min="1" value="1" name="minstudent"/>
      <input type="number" min="1"  value="1" name="maxstudent"/>
      <input type="text" placeholder="Duration..." name="duration"/>
      <div class="hidden"><input type="file" id="upload-services" name="uploadServices"></div>
      <button type="button" id="btn-browse-services" name="btn-browse">BROWSE</button>
      <button type="submit" id="btn-upload-services" name="btn-upload">SAVE</button>
      <progress id='progressor' value="0" max='100' style=""></progress>

    </form>
</div>
