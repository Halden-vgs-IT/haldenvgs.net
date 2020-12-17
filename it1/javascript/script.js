//*-~*~-*-*-~*~-*-*-~*~*-*-~*~-*-*-~*~-*
//
//　　　　　　　　Made with ❤ by ~
//　　　　　　 Areal Alien ❥ 雷克斯
//
//　　　　　　　　　　▄▀▄　　　▄▀▄
//　　　　　　　　 ▄█░░▀▀▀▀▀░░█▄
//　　　　　▄▄ 　█░░░░░░░░░░░█　▄▄
//　　　　█▄▄█　█░░▀░░┬░░▀░░█　█▄▄█
//*-~*~-*-*-~*~-*-*-~*~*-*-~*~-*-*-~*~-*

let navIcon = $('#nav-button');
let menu = $("#menu");
let body = $("body");

navIcon.click(function(){
    if(navIcon.hasClass('open')) {
        navIcon.toggleClass('open');
        navIcon.css("transform", "rotate(0deg)");
        menu.css("opacity", "0");
        menu.css("pointer-events", "none");
        body.css("overflow", "auto");
    } else {
        navIcon.toggleClass('open');
        navIcon.css("transform", "rotate(90deg)");
        menu.css("opacity", "1");
        menu.css("pointer-events", "auto");
        body.css("overflow", "hidden");
    }
});

// Disable drag on image
$('img').on('dragstart', function(event) { event.preventDefault(); });