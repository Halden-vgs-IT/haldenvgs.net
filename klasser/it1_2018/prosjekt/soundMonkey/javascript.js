var script = document.createElement('script');

script.src = "https://www.gstatic.com/charts/loader.js";

script.src = "https://canvasjs.com/assets/script/canvasjs.min.js";



//index.php



function onHoverThird() {

    document.getElementsByTagName("div")[0].style.opacity = "0.4";

    document.getElementsByTagName("div")[0].style.transition = "0.5s";

}

function onNotHover() {

    document.getElementsByTagName("div")[0].style.opacity = "0";

}

function togglePassword() {

    var x = document.getElementById("password");

    x.value = "";

    x.type = "password";

}





//mainMenu.php



function hoverLeft() {

    document.getElementsByClassName("uil uil-video")[0].style.color = "var(--secondary-color)";

    document.getElementsByClassName("uil uil-video")[0].style.transition = "0.5s";

}

function hoverLeftFalse() {

    document.getElementsByClassName("uil uil-video")[0].style.color = "var(--primary-color)";

    document.getElementsByClassName("uil uil-video")[0].style.transition = "0.5s";

}

function hoverRight() {

    document.getElementsByClassName("right")[0].style.backgroundColor = "var(--secondary-color)";

    document.getElementsByClassName("right")[0].style.transition = "0.5s";

}

function hoverRightFalse() {

    document.getElementsByClassName("right")[0].style.backgroundColor = "var(--primary-color)";

    document.getElementsByClassName("right")[0].style.transition = "0.5s";

}



//selectSensor.html



function hoverAlpha() {

    document.getElementsByClassName("alpha")[0].style.color = "var(--secondary-color)";

    document.getElementsByClassName("alpha")[0].style.transition = "0.5s";

}

function hoverAlphaFalse() {

    document.getElementsByClassName("alpha")[0].style.color = "var(--primary-color)";

    document.getElementsByClassName("alpha")[0].style.transition = "0.5s";

}

function hoverBeta() {

    document.getElementsByClassName("right")[0].style.backgroundColor = "var(--secondary-color)";

    document.getElementsByClassName("right")[0].style.transition = "0.5s";

}

function hoverBetaFalse() {

    document.getElementsByClassName("right")[0].style.backgroundColor = "var(--primary-color)";

    document.getElementsByClassName("right")[0].style.transition = "0.5s";

}