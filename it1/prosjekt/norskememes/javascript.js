// navbar button
let navBtn = $('#nav-button');

navBtn.click(function() {
    if(navBtn.hasClass('open')) {
        navBtn.toggleClass('open');
        navBtn.css("transform", "rotate(0deg)");
    } else {
        navBtn.toggleClass('open');
        navBtn.css("transform", "rotate(90deg)");
    }
});

// navbar logo
let index = $("#Layer_1");

index.click(function() {
    window.location.href = 'index.php';
});

// navbar profile picture wrapper
let profilePicture = $(".profile-picture");
let menu = $("#menu");

profilePicture.click(function() {

    if(menu.hasClass('open')) {
        menu.toggleClass('open');
        menu.css("display", "none");
    } else {
        menu.toggleClass('open');
        menu.css("display", "block");
    }

});

let choosePP = $("#choose-profile-picture");
let uploaderPP = $("#profile-pic-uploader");

$(document).ready(function(){
    choosePP.change(function(){
        uploaderPP.css("display", "flex")
    });
});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile-img-tag').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#choose-profile-picture").change(function(){
    readURL(this);
});


let profilePicWrapper = $(".profile-pic-wrapper");
let profilePicNote = $(".profile-pic-note");
profilePicWrapper.on({
    mouseenter: function () {
        profilePicNote.css("top", "110%");
        profilePicNote.css("opacity", "1");
    },
    mouseleave: function () {
        profilePicNote.css("top", "105%");
        profilePicNote.css("opacity", "0");
    }
});