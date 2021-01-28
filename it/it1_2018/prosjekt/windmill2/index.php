<!DOCTYPE html>

<html lang="no">

<head>

    <meta charset="UTF-8">

    <title>Hjem</title>

    <link rel="stylesheet" href="css/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/utils/Draggable.min.js"></script>

</head>

<body>

<p>

<div id="windmill">

    <div id="stick"></div>

    <div id="wind">

        <div id="wind1"></div>

        <div id="wind2"></div>

        <div id="wind3"></div>

        <div id="wind4"></div>

    </div>

</div>

<label for="slider"></label>

<input id="slider" type="range" min="0" max="15" value="0" step="0.01">



<div class="windSpeed">

    <h1>Vindhastighet:</h1>

    <p id="windSpeed">0</p>

    <p class="sufix">m/s</p>

</div>

<div class="powerOutput">

    <h1>Strømuttak:</h1>

    <p id="powerOutput">0</p>

    <p class="sufix">kW</p>

</div>

<article>

    <p>Dersom man beveger på slideren ovenfor vil vindhastigheten øke, og vindmøllen vil derfor begynne å rotere. Den vil på en annen side ikke produsere noe strøm før vinden stiger over 3m/s og den vil ikke kunne produsere mer enn 3600kW.</p>

</article>



</body>

<script>

    function isIE() {

        ua = navigator.userAgent;

        var is_ie = ua.indexOf("MSIE ") > -1 || ua.indexOf("Trident/") > -1;



        return is_ie;

    }

    if (isIE()){

        alert('You are currently using an unsupported browser! Try using Google Chrome.');

        location.href = 'https://www.google.com/intl/no/chrome/';

    }



    var slider = document.getElementById("slider");

    var windStrength = document.getElementById("windSpeed");

    var output = document.getElementById("powerOutput");





    slider.oninput = function (){

        var power = (-2.1524)*slider.value**4+(56.814)*slider.value**3-(483.27)*slider.value**2+(1848.7)*slider.value-2565.3;

        var powerOutput = power.toFixed(0);

        windStrength.innerHTML = this.value;

        output.innerHTML = powerOutput;

        if (slider.value <= 3)

            output.innerHTML= 0;

        if (slider.value >= 12)

            output.innerHTML= 3600;

        TweenMax.to(["#wind"], 10, {rotationZ: "+="+slider.value * 360, repeat: -1,ease: Power0.easeNone})

    }



</script>

</html>