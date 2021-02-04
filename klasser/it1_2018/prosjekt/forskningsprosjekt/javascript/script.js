$(document).ready(function() {



    let $win = $(window);

    let winH2 = $(".seksjon1").offset().top - 100;

    let winH3 = $(".seksjon2").offset().top - 25;

    let winH4 = $(".seksjon3").offset().top - 25;

    let winH5 = $(".seksjon4").offset().top - 35;



    $win.on("scroll", function () {

        if ($(this).scrollTop() > winH2 ) {

            $("#nav-item1").css("color", "var(--blå-lys)");

            $("#nav-item2").css("color", "var(--hvit)");

            $("#nav-item3").css("color", "var(--hvit)");

            $("#nav-item4").css("color", "var(--hvit)");

        } else {

            $("#nav-item1").css("color", "var(--hvit)");

        }



        if ($(this).scrollTop() > winH3 ) {

            $("#nav-item1").css("color", "var(--hvit)");

            $("#nav-item2").css("color", "var(--blå-lys)");

            $("#nav-item3").css("color", "var(--hvit)");

            $("#nav-item4").css("color", "var(--hvit)");

        } else {

            $("#nav-item2").css("color", "var(--hvit)");

        }



        if ($(this).scrollTop() > winH4 ) {

            $("#nav-item1").css("color", "var(--hvit)");

            $("#nav-item2").css("color", "var(--hvit)");

            $("#nav-item3").css("color", "var(--blå-lys)");

            $("#nav-item4").css("color", "var(--hvit)");

        } else {

            $("#nav-item3").css("color", "var(--hvit)");

        }



        if ($(this).scrollTop() > winH5 ) {

            $("#nav-item1").css("color", "var(--hvit)");

            $("#nav-item2").css("color", "var(--hvit)");

            $("#nav-item3").css("color", "var(--hvit)");

            $("#nav-item4").css("color", "var(--blå-lys)");

        } else {

            $("#nav-item4").css("color", "var(--hvit)");

        }

    }).on("resize", function(){

        winH2 = $(this).height();

        winH3 = $(this).height();

        winH4 = $(this).height();

        winH5 = $(this).height();

    });



});



// variables

let timing = 150;

let easing = "easeInSine";



$(document).ready(function() {



    $("#seksjon1-link").click(function() {

        $('html, body').animate({

            scrollTop: $(".seksjon1").offset().top - 75

        }, timing, easing);

    });



    $("#seksjon2-link").click(function() {

        $('html, body').animate({

            scrollTop: $(".seksjon2").offset().top - 75

        }, timing, easing);

    });



    $("#seksjon3-link").click(function() {

        $('html, body').animate({

            scrollTop: $(".seksjon3").offset().top - 75

        }, timing, easing);

    });



    $("#seksjon4-link").click(function() {

        $('html, body').animate({

            scrollTop: $(".seksjon4").offset().top - 75

        }, timing, easing);

    });



});



let navBtn = $('#nav-button');

let menu = $('#menu');



navBtn.click(function() {

    if(navBtn.hasClass('open')) {

        navBtn.toggleClass('open');

        menu.css("opacity", "0");

        menu.css("pointer-events", "none");

    } else {

        navBtn.toggleClass('open');

        menu.css("opacity", ".8");

        menu.css("pointer-events", "auto");

    }

});