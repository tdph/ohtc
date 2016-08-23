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
    // Navigate to About Us
    $('.aboutus-tabs div').on('click', function() {
        var id = $(this).data("id");
        $('.aboutus-tab-page').fadeOut(200).delay(200);
        $('#'+id).fadeIn(200)
    })
});
