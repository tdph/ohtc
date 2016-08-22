$( document ).ready(function() {
    // Get started!
    $('ul.nav li').on('click', function() {
        var id = $(this).attr('id');
        if(id == "home") { window.location = "."; }
        else { window.location = id + ".php"; }
    })
});
