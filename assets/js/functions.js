function edit(id){
  window.location = './admin.php?page=aboutus&edit=ourteam&id='+id;
}
function editGallery(id){
  window.location = './admin.php?page=gallery&edit=gallery&id='+id;
}
function editNews(id){
  window.location = './admin.php?page=news&edit=news&id='+id;
}
function GetSelectedPage(page, limit){
    page = page !== undefined ? page : 1;
    limit = limit !== undefined ? limit : 5;
    var form = new FormData();
    form.append("page",page);
    form.append("limit",limit);
    $.ajax({
        url:" parser/news_select.php", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data:form, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {
            if(data!="") {
                //alert(data); return; //- debugging
                var resp = JSON.parse(data);
                var count = Object.keys(resp).length;
                var dir = "assets/img/news/";
                for(var i =0;i<count;i++) {
                    $("#enca").append("<div class='article_wrapper dark' id='"+resp[i].id+"'><h3>"+resp[i].title+"</h3>" +
                    "<h5>"+resp[i].dateadded+"</h5>"+
                    "<p><img src='"+resp[i].imagepath+"' alt='news'"+resp[i].id+" />"+resp[i].content+"</p><hr></div>");
                }
            }
        },
        error: function(data) { console.log(data); },
    });
}

function GetPages(){
    $.ajax({
        url:" parser/news_select.php", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data:"", // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {
            if(data!=""){
                //alert(data); return; //- debugging
                var resp = JSON.parse(data);
                var count = Object.keys(resp).length;
                for(var i=0;i<count/5;i++){
                    $("#pagination").append("<li><a href='./news.php?page="+(i+1)+"'>"+(i+1)+"</a></li>");
                }
            }
        },
        error: function(data) { console.log(data); },
    });
}
function readURL(input,output) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#'+output).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function getOurTeam() {

    $.ajax({
        url:" parser/ourteam_select.php", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data:"", // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {
            if(data!=""){
                  var resp = JSON.parse(data);
                  var count = Object.keys(resp).length;
                  var cnt = 0;
                  var ourteam = "";
                  for(var i = 0; i < count; i++) {
                      cnt++;
                      var team = "";
                      if(cnt == 1) { team = '<div class="ot_wrapper">'; }
                      team += '<div class="c-xs-6 c-sm-3">' +
                          '<img src="'+resp[i].imagepath+'" alt="tuason" />' +
                          '<div class="details">' +
                              '<h4>'+resp[i].name+'</h4>' +
                              '<h5>'+resp[i].position+'</h5>' +
                              '<p>'+resp[i].description+'</p>' +
                          '</div>' +
                      '</div>';
                      if(cnt == 4) { team += '</div>'; cnt = 0; }
                      ourteam += team;
                  }
                  $('#ourteam').html(ourteam);
              }
        },
        error: function(data) { console.log(data); },
    });
}

function getGallery(admin) {
    admin = admin !== undefined ? admin : false;
    $.ajax({
        url:" parser/gallery_select.php", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data:"", // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {
            if(data!=""){
                var resp = JSON.parse(data);
                var count = Object.keys(resp).length;
                var x = 0;
                var c = 0;
                var ourteam = "";
                for(var i = 0; i < count; i++) {
                    if(c == 0) { x++; $("#gallery_container").append("<div id='gc" + x + "' class='gallery_wrapper'>"); }
                    $("#gc"+x).append("<a href='" + resp[i].imagepath + "' data-lightbox='" + resp[i].title + "' data-title='" + resp[i].title + "'><div class='image_wrapper c-sm-6 c-md-3'>" +
                    //"<span data-id='gallery" + resp[i].id +"' class='btn-remove-carousel glyphicon glyphicon-remove'></span>" +
                    "<img src='" + resp[i].imagepath + "'><span class='image-title'>" + resp[i].title + "</span></div></a>");
                    c++;
                    if(c == 4) { c = 0; $(".content").append("</div>"); }
                }
                $('#ourteam').html(ourteam);
             }
        },
        error: function(data) { console.log(data); },
    });
}

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
        getOurTeam();
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
    else if(url.toLowerCase().indexOf("gallery.php") >= 0) { // =====> GALLERY <=====
        // Load Gallery Images
        getGallery();
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

        $('#btn-update-team').on('click',function(){
            var id = _("btn-update-team").value;
            UploadFor_Team(true,id);
        })

        $('#btn-update-gallery').on('click',function(){
            var id = _("btn-update-gallery").value;
            UploadFor_Gallery(true,id);
        })

        $('#btn-update-news').on('click',function(){
            var id = _("btn-update-news").value;
            UploadFor_News(true,id);
        })


        $('#btn-cancel-news').on('click',function(){
              window.location = './admin.php?page=news';
        })

        $('#btn-cancel-gallery').on('click',function(){
              window.location = './admin.php?page=gallery';
        })
        $('#btn-cancel-team').on('click',function(){
              window.location = './admin.php?page=aboutus';
        })

        $('.btn-remove-news').on('click',function(){

              var id = $(this).data("id");
              var frm =  new FormData();
              frm.append("id", id);
              frm.append("imgsrc","../"+$('#news'+id).attr("src"));
              AjaxUsingJquery(frm,"parser/news_delete.php","./admin.php?page=news",false);
        })

        $('.btn-remove-ourteam').on('click',function(){
              var id = $(this).data("id");
              var frm =  new FormData();
              frm.append("id", id);
              frm.append("imgsrc","../"+$('#ourteam'+id).attr("src"));

              AjaxUsingJquery(frm,"parser/ourteam_delete.php","./admin.php?page=aboutus",false);
        })
        $('.btn-remove-carousel').on('click', function() {
            var id = $(this).data("id");
            var frm =  new FormData();
            frm.append("file","../"+$('#'+id).attr("src"));
            AjaxUsingJquery(frm,"parser/removepic.php","./admin.php?page=home",false);
        })
        $('.btn-remove-facility').on('click', function() {

            var id = $(this).data("id");
            var frm =  new FormData();
            frm.append("file","../"+$('#'+id).attr("src"));
            AjaxUsingJquery(frm,"parser/removepic.php","./admin.php?page=aboutus",false);
        })
        $('.btn-remove-gallery').on('click', function() {
            var id = $(this).data("id");
            var imgsrc = $('#gallery'+id).attr("src");
            var frm =  new FormData();
            frm.append("id", id);
            frm.append("imgsrc", imgsrc);
            AjaxUsingJquery(frm,"parser/gallery_delete.php","./admin.php?page=gallery",false);
        })
        $('#add-objectives-services').on('click', function() {
            addObjective("txtobj");
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
                    // alert(data); return; //- debugging
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


    function UploadFor_Carousel() {
        var frm =  new FormData();
        frm.append("file",_('upload-carousel').files[0]);
        frm.append("fixedwidth",1140);
        frm.append("fixedheight",679);
        frm.append("type","carousel");
        frm.append("newname","");
        AjaxUsingJquery(frm,"parser/uploadpic.php","./admin.php?page=home",true,'progressor');
    }
    function UploadFor_Team(isupdate,id) {
        isupdate = isupdate !== undefined ? isupdate : false;
        id = id !== undefined ? id : -1;
        if(_('team-name').value.trim()==""){alert("Name required"); return;}
        if(_('team-position').value.trim()==""){alert("Position required"); return;}
        if(_('team-description').value.trim()==""){alert("Description required"); return;}
        if(_('imgteam').src=="" && _('upload-team').files.length==0){ alert("Browse photo required"); return; }

        var frm =  new FormData();
        frm.append("file",_('upload-team').files[0]);
        frm.append("fixedwidth",150);
        frm.append("fixedheight",150);
        frm.append("name",_('team-name').value);
        frm.append("position",_('team-position').value);
        frm.append("description",_('team-description').value);

        if(isupdate==false && id==-1)AjaxUsingJquery(frm,"parser/ourteam_insert.php","./admin.php?page=aboutus",true,'progressorteam');
        if(isupdate==true && id!=-1){

           frm.append("id",id);
           frm.append("pictureupdate",(_('imgteam').src!="" && _('upload-team').files.length==0)?false:true);
           AjaxUsingJquery(frm,"parser/ourteam_update.php","./admin.php?page=aboutus",true,'progressorteam');

        }
    }

    function UploadFor_Gallery(isupdate,id){
        isupdate = isupdate !== undefined ? isupdate : false;
        id = id !== undefined ? id : -1;
        if(_('gallery-title').value.trim()==""){ alert("Title required"); return;}
        if(_('gallery-description').value.trim()==""){alert("Description required"); return;}
        if(_('galleryimg').src=="" && _('upload-gallery').files.length==0){alert("Browse a photo required");return;}

        var frm =  new FormData();
        frm.append("file",_('upload-gallery').files[0]);
        frm.append("title",_('gallery-title').value);
        frm.append("description",_('gallery-description').value);

        if(isupdate==false && id==-1)AjaxUsingJquery(frm,"parser/gallery_insert.php","./admin.php?page=gallery",true,'progressorgallery');
        if(isupdate==true && id!=-1){
            frm.append("id",id);
            frm.append("pictureupdate",(_('galleryimg').src!="" && _('upload-gallery').files.length==0)?false:true);
            AjaxUsingJquery(frm,"parser/gallery_update.php","./admin.php?page=gallery",true,'progressorgallery');
        }
    }
    function UploadFor_News(isupdate,id){
        isupdate = isupdate !== undefined ? isupdate : false;
        id = id !== undefined ? id : -1;
        if(_('news-title').value.trim()==""){ alert("Title required"); return;}
        if(_('news-date').value.trim()==""){alert("Date required"); return;}
        if(_('news-description').value.trim()==""){alert("Description required"); return;}
        if(_('newsimg').src!='' && _('upload-news').files.length==0){alert("Browse a photo required");return;}

        var frm =  new FormData();
        frm.append("file",_('upload-news').files[0]);
        frm.append("title",_('news-title').value);
        frm.append("date",_('news-date').value);
        frm.append("content",_('news-description').value);

        if(isupdate==false && id==-1)AjaxUsingJquery(frm,"parser/news_insert.php","./admin.php?page=news",false,'');
        if(isupdate==true && id!=-1){
            frm.append("id",id);
            frm.append("pictureupdate",(_('newsimg').src!="" && _('upload-news').files.length==0)?false:true);
            AjaxUsingJquery(frm,"parser/news_update.php","./admin.php?page=news",false,'');
        }
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


    function _(e){return document.getElementById(e);}

    $("#form_services").on('submit', function(e) {

          e.preventDefault();
          var frm =  new FormData(this);
          frm.append("modules",window.modules);
          frm.append("objectives",window.objectives);
          AjaxUsingJquery(frm,"parser/services_insert.php","./admin.php?page=services",true,'progressor');
    });
});
