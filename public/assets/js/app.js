$(document).ready(function(){

    // Start Left Sidebar
    $(".sidebarlinks").click(function(){
        $('.sidebarlinks').removeClass('current');
        $(this).addClass('current');
    })
    // End Left Sidebar

    // Start copyright Section
    var getyear = new Date().getUTCFullYear();
    $("#getyear").html(getyear);
    // End copyright Section
});
