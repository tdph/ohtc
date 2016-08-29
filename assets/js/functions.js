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
    else if(url.toLowerCase().indexOf("services") >= 0) { // =====> SERVICES <=====
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
        $('.btn-remove-carousel').on('click', function() {
            var id = $(this).data("id");
            alert($('#'+id).attr("src"));
        })
    }
});
