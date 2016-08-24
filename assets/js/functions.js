// Remove shadow on selected page's content
$("#gallery_container, .article_wrapper").parents('.content').css("box-shadow", "none");
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
    if(url.contains("aboutus")) { // =====> ABOUT US <=====
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
    else if(url.contains("services")) { // =====> SERVICES <=====
        
    }
    else if(url.contains("gallery")) { // =====> GALLERY <=====
        // Get Gallery Immages from DB
        var gallery_dir = "assets/img/gallery/";
        var gallery_images = [ "fruir carving b.jpg", "fruit carving.jpg" ];

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
});
