// Remove shadow on selected page's content
$("#gallery_container, .article_wrapper.dark, .admin-pages").parents('.content').css("box-shadow", "none");
$( document ).ready(function() {
    // Get started!
    // Navigate to pages
    $('ul.nav li').on('click', function() {
        var id = $(this).attr('id');
        if(id == "home") { window.location = "."; }
        else { window.location = id + ".php"; }
    })
    // Toggle Navigation
    $('.toggle').on('click', function() {
        $('.nav').toggleClass('toggle-nav');
    })

    var url = window.location.href;
    if (url.toLowerCase().indexOf("aboutus.php") >= 0) { // =====> ABOUT US <=====

        // Navigate to About Us
        $('.aboutus-tabs div').on('click', function() {
            var id = $(this).data("id");
            $('.aboutus-tab-page').fadeOut(200).delay(200);
            $('#'+id).fadeIn(200)
        })
        // Load Images to Our Facilities
        var dir = "assets/img/aboutus/ourfacilities/";
        $.ajax({
            type: "GET",
            url: "parser/getfacilitiesimages.php",
            data: { "dir" : dir },
            dataType: "json",
            success: function (data) {
                $.each(data, function(i, filename) {
                    if(filename.match(/\.(jpe?g|png|gif)$/)) {
                        $("#image_container").append("<div class='image_wrapper c-sm-6 c-md-3'><img src='" + dir + filename + "'><span class='image-title'>" +
                        decodeURIComponent(filename.substr(0, filename.lastIndexOf('.'))) + "</span></div>");
                    }
                });
            }
        });
    }
    else if(url.toLowerCase().indexOf("services.php") >= 0) { // =====> SERVICES <=====

        $('.service_wrapper').on('click', function() {
            $(this).find('.services_content').toggleClass('isshow');
            $(this).find('.glyphicon').toggleClass('toggle');
        })
    }
    else if(url.toLowerCase().indexOf("gallery") >= 0) { // =====> GALLERY <=====


        // Get Gallery Immages from DB
        var gallery_dir = "assets/img/gallery/";
        var gallery_images = [ "fruit carving b.jpg", "fruit carving.jpg" ];

        // Load Gallery Images
        var c = 0;
        var x = 0;
        $.each(gallery_images, function(key, value) {
            if(c == 0) { x++; $("#gallery_container").append("<div id='gc" + x + "' class='gallery_wrapper'>"); }
            $("#gc"+x).append("<div class='image_wrapper c-sm-6 c-md-3'><img src='" + gallery_dir + value + "'><span class='image-title'>" +
            decodeURIComponent(value.substr(0, value.lastIndexOf('.'))) + "</span></div>");
            c++;
            if(c == 4) { c = 0; $(".content").append("</div>"); }
        })



    }
    else if(url.toLowerCase().indexOf("admin") >= 0) {

        $('.btn-back').on('click', function() {
            window.location = "admin.php";
        })

        $('#btn-browse-carousel').on('click', function() {
            $('#upload-carousel').trigger('click');
        })
        $('#btn-browse-team').on('click', function() {
            $('#upload-team').trigger('click');
        })
        $('#btn-browse-facility').on('click', function() {
            $('#upload-facility').trigger('click');
        })
        $('#btn-browse-news').on('click', function() {
            $('#upload-news').trigger('click');
        })
        $('#btn-browse-services').on('click', function() {
            $('#upload-services').trigger('click');
        })


        $('.btn-remove-carousel').on('click', function() {
            var id = $(this).data("id");
            var frm =  new FormData();
            frm.append("file","../"+$('#'+id).attr("src"));
            AjaxUsingJquery(frm,"parser/removepic.php","./admin.php?page=home",false);
        })
        $('.btn-remove-facility').on('click', function() {
          //
          var id = $(this).data("id");
          var frm =  new FormData();
          frm.append("file","../"+$('#'+id).attr("src"));
          AjaxUsingJquery(frm,"parser/removepic.php","./admin.php?page=aboutus",false);

        })
        $('#add-objectives-services').on('click', function() {
            addObjective("txtobj");d
        })
        $('#add-module-services').on('click', function() {
            addModule("txtmod");
        })
        $('#btn-upload-carousel').on('click', function(){
            UploadFor_Carousel();
        })
        $('#btn-upload-team').on('click', function(){
            UploadFor_Team();
        })
        $('#btn-upload-facility').on('click', function(){
            UploadFor_Facility();
        })
        $('#btn-upload-news').on('click', function(){
            UploadFor_News();
        })


    }
    $('#btn-browse-gallery').on('click', function() {
        $('#upload-gallery').trigger('click');
    })
    $('#btn-upload-gallery').on('click', function(){
        UploadFor_Gallery();
    })

    function AjaxUsingJquery(form,url,reloadurl,hasprogressbar,progressbarname){

          $.ajax({
              url:url, // Url to which the request is send
              type: "POST",             // Type of request to be send, called as method
              data:form, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
              contentType: false,       // The content type used when sending data to the server.
              cache: false,             // To unable request pages to be cached
              processData:false,        // To send DOMDocument or non processed data file it is set to false
              success: function(data)   // A function to be called if request succeeds
              {
                     //alert(data); return; //- debugging
                     var resp = JSON.parse(data);
                     if(resp.status=="failed"){
                         if(hasprogressbar==true){
                             $('#'+progressbarname).css("width", 0);
                             $('#'+progressbarname).attr("aria-valuenow", 0);
                         }
                         alert(resp.data);
                     }
                     if(resp.status=="success") {
                         alert(resp.data);
                         window.location  = reloadurl;
                     }
              },
              error: function(data) { console.log(data); },
              complete: function(data) { console.log("Completed."); },
              progress: function(evt) {
                  if(hasprogressbar==true){
                      if (evt.lengthComputable) {
                          var prctg = parseInt(Math.ceil(evt.loaded/evt.total) * 100 ) + '%';
                          $('#'+progressbarname).css("width", prctg);
                          $('#'+progressbarname).attr("aria-valuenow", prctg);
                      }
                      else {
                          console.log("Length not computable.");
                      }
                  }
              }
          });
    }


    function UploadFor_Carousel(){

        var frm =  new FormData();
        frm.append("file",_('upload-carousel').files[0]);
        frm.append("fixedwidth",1140);
        frm.append("fixedheight",679);
        frm.append("type","carousel");
        frm.append("newname","");
        AjaxUsingJquery(frm,"parser/uploadpic.php","./admin.php?page=home",true,'progressor');

    }
    function UploadFor_Team(){

        if(_('team-name').value.trim()==""){alert("Name required"); return;}
        if(_('team-position').value.trim()==""){alert("Position required"); return;}
        if(_('team-description').value.trim()==""){alert("Description required"); return;}
        if(_('upload-team').files.length==0){alert("Browse photo required"); return;}

        var frm =  new FormData();
        frm.append("file",_('upload-team').files[0]);
        frm.append("fixedwidth",150);
        frm.append("fixedheight",150);
        frm.append("name",_('team-name').value);
        frm.append("position",_('team-position').value);
        frm.append("description",_('team-description').value);

        AjaxUsingJquery(frm,"parser/ourteam_insert.php","./admin.php?page=aboutus",true,'progressorteam');

    }
    function UploadFor_Facility(){

        if(_('facility-name').value.trim()==""){ alert("Facility name required"); return;}

        var frm =  new FormData();
        frm.append("file",_('upload-facility').files[0]);
        frm.append("fixedwidth",700);
        frm.append("fixedheight",400);
        frm.append("type","facility");
        frm.append("newname",_('facility-name').value);
        AjaxUsingJquery(frm,"parser/uploadpic.php","./admin.php?page=aboutus",true,'progressorfacility');

    }
    function UploadFor_News(){

        if(_('news-title').value.trim()==""){ alert("Title required"); return;}
        if(_('news-date').value.trim()==""){alert("Date required"); return;}
        if(_('news-description').value.trim()==""){alert("Description required"); return;}
        if(_('upload-news').files.length==0){alert("Browse a photo required");return;}

        var frm =  new FormData();
        frm.append("file",_('upload-news').files[0]);
        frm.append("title",_('news-title').value);
        frm.append("date",_('news-date').value);
        frm.append("content",_('news-description').value);
        AjaxUsingJquery(frm,"parser/news_insert.php","./admin.php?page=news",false,'');

    }
    function UploadFor_Gallery(){
      
      if(_('gallery-title').value.trim()==""){ alert("Title required"); return;}
      if(_('gallery-description').value.trim()==""){alert("Description required"); return;}
      if(_('upload-gallery').files.length==0){alert("Browse a photo required");return;}

      var frm =  new FormData();
      frm.append("file",_('upload-gallery').files[0]);
      frm.append("title",_('gallery-title').value);
      frm.append("description",_('gallery-description').value);
      AjaxUsingJquery(frm,"parser/gallery_insert.php","./admin.php?page=gallery",true,'progressorgallery');

    }
    function _(e){return document.getElementById(e);}

    $("#form_services").on('submit', function(e) {

          e.preventDefault();
          var frm =  new FormData(this);
          frm.append("modules",window.modules);
          frm.append("objectives",window.objectives);
          AjaxUsingJquery(frm,"parser/services_insert.php","./admin.php?page=services",true,'progressor');
    });
});
