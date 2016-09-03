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
            alert($('#'+id).attr("src"));
        })
        $('#add-objectives-services').on('click', function() {
             addObjective("txtobj");
        })
        $('#add-module-services').on('click', function() {
             addModule("txtmod");
        })
        $('#btn-upload-carousel').on('click',function(){

           UploadPicForCarousel();
        })

    }





    function UploadPicForCarousel(){

        var frm =  new FormData();
        frm.append("file",_('upload-carousel').files[0]);
        $.ajax({
            url: "parser/uploadpic.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data:frm, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                alert(data );
                //  var resp = JSON.parse(data);
                //  if(resp.status=="failed"){ _('progressor').value  = 0; alert(resp.data);}
                 //
                //  if(resp.status=="success") {  window.location  = "./admin.php?page=services";  }

            },
            error: function(data) { console.log(data); },
            complete: function() { console.log("Completed."); },
            progress: function(evt) {

                if (evt.lengthComputable) {
                  //  _('progressor').value =  parseFloat(Math.ceil(evt.loaded/evt.total) * 100 );//+ '%';
                }
                else {
                    console.log("Length not computable.");
                }
            }
        });
    }

    function _(e){return document.getElementById(e);}
    $("#form_services").on('submit', function(e) {

        e.preventDefault();
        var frm =  new FormData(this);
        frm.append("modules",window.modules);
        frm.append("objectives",window.objectives);
       //  if(_('upload-services').files.length==0){alert("no file selected"); return;}
        $.ajax({
            url: "parser/services_insert.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data:frm, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                 var resp = JSON.parse(data);
                 if(resp.status=="failed"){ _('progressor').value  = 0; alert(resp.data); }
                 if(resp.status=="success") {  window.location  = "./admin.php?page=services";  }
            },
            error: function(data) { console.log(data); },
            complete: function() { console.log("Completed."); },
            progress: function(evt) {

                if (evt.lengthComputable) {
                    _('progressor').value =  parseFloat(Math.ceil(evt.loaded/evt.total) * 100 );//+ '%';
                }
                else {
                    console.log("Length not computable.");
                }
            }
        });
    });
});
