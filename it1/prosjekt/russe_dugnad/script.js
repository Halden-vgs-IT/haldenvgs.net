console.log("Javascript: connected");
$(document).ready(function () {
    $('#map').addClass('scrolloff');                // set the mouse events to none when doc is ready

    $('#overlay').on("mouseup",function(){          // lock it when mouse up
        $('#map').addClass('scrolloff');
        //somehow the mouseup event doesn't get call...
    });
    $('#overlay').on("mousedown",function(){        // when mouse down, set the mouse events free
        $('#map').removeClass('scrolloff');
    });
    $("#map").mouseleave(function () {              // becuase the mouse up doesn't work...
        $('#map').addClass('scrolloff');            // set the pointer events to none when mouse leaves the map area
                                                    // or you can do it on some other event
    });

});
function Scrolldown() {
    window.location.hash = '#breaker';
}
window.onload = Scrolldown;
var scrolled=0;
$("#scroller").click(function() {
    $('html,body').animate({
        scrollTop: $(".second").offset().top},
        'slow');
});
$("#scroller2").click(function() {
    $('html,body').animate({
        scrollTop: $(".info").offset().top},
        'slow');
});
$(window).bind("load", function() {
   $("#loading").css("display","none")
});
//document.getElementById('breaker').scrollIntoView({block: 'start', behavior: 'smooth'});
