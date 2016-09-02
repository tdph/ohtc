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

      <script>
          //** OBJECTIVE - SERVICES
          setthingsup();
          function setthingsup() {
              objectives = [];
          }
          function addObjective(e) {
              var x = _(e).value;

              if(x != '') {
                  var i = window.objectives.length;
                  window.objectives[i] = [];
                  window.objectives[i][0] = x;

                  _(e).value = "";
                  displayObjectives();


                //  alert(window.objectives.length);
              }
          }

          function displayObjectives() {
              _('objectives').innerHTML = "";
              if(window.objectives.length > 0) {
              for(var i=0; i < window.objectives.length; i++) {
                var c = window.objectives[i];
                _('objectives').innerHTML += '<tr><td width="60%">'+c[0]+'</td><td width="40%">'+'<a onclick="deleteObjective(' + i + ')" style="cursor:pointer;color:red;float:right;margin-right:5px;">X</a></td></tr>';
              }
            }
          }
          function deleteObjective(e){
            window.objectives.splice(e,1);
            displayObjectives();
          }
          //** OBJECTIVE - SERVICES
      </script>
      <input type="text" placeholder="objectives" id="txtobj"/>
      <button type="button" id="add-objectives-services" name="add-objectives-services" >ADD</button>
      <table id="objectives">
      </table>

      <script>
          function _(e){return document.getElementById(e);}
          //** MODULE - SERVICES
          setthingsup();
          function setthingsup() {
              modules = [];
          }
          function addModule(e) {
              var x = _(e).value;

              if(x != '') {
                  var i = window.modules.length;
                  window.modules[i] = [];
                  window.modules[i][0] = x;

                  _(e).value = "";
                  displayModules();
              }
          }

          function displayModules() {
              _('modules').innerHTML = "";
              if(window.modules.length > 0) {
              for(var i=0; i < window.modules.length; i++) {
                var c = window.modules[i];
                _('modules').innerHTML += '<tr><td width="60%">'+c[0]+'</td><td width="40%">'+'<a onclick="deleteModule(' + i + ')" style="cursor:pointer;color:red;float:right;margin-right:5px;">X</a></td></tr>';
              }
            }
          }
          function deleteModule(e){
            window.modules.splice(e,1);
            displayModules();
          }
          //** MODULE - SERVICES
      </script>
      <input type="text" placeholder="module" id="txtmod"/>
      <button type="button" id="add-module-services" name="add-module-services" >ADD</button>
      <table id="modules">
      </table>

      <progress id='progressor' value="0" max='100' style=""></progress>
      <button type="submit" id="btn-upload-services" name="btn-upload">SAVE</button>
    </form>
</div>
