var odd = 0;
//quick fix for 0 division
var obj = ".flaps";

$('#wing-r').on('click', function () {

    TweenMax.to(".flaps", 0.1, { directionalRotation: "+=360_cw", repeat: -1, ease: Linear.easeNone });

});

$('document').ready(function() {
    $('#click').click(function () {
        console.log(odd);
        if(odd == 0) {
            $('.sidenav').css('right', '0');
            $('.sidenav').css('opacity', '100');

            odd++;
        } else {
            $('.sidenav').css('opacity', '0');
            odd--;
        }
    });

//normal

    //Increase speed if needed
    const multiplier = 2.5;


    var slider = document.getElementById("myRange");
    var output = document.getElementById("powerOutput");
    // Display the default slider value
// Update the current slider value (each time you drag the slider handle)
    var count = 0;
    if (count == 0) {
        var power = vindTilKW(value);
        var time = tid(value);
        if (value <= 3) {
            document.getElementById("powerSpan").innerHTML = "";
            output.innerHTML = "Ubrukelig";
        } else {
            document.getElementById("powerSpan").innerHTML = "Kw";
            output.innerHTML = power;
        }
        document.getElementById("vindOutput").innerHTML = value;
        var windAnim = TweenMax.to(obj, time, {rotationZ: 360, repeat: -1, ease: Linear.easeNone}, {timescale: 0});

        count++;
    }
    //I got sick of commenting...
    var isNull = false;
    slider.oninput = function () {
        
        var MSW = this.value;
        if (MSW == 0) {
            isNull = true;
        }

        var ss = document.getElementsByClassName("flaps")[0]._gsTransform.rotation;
        var currentROT = "rotate(" + ss + "deg)";
        document.getElementsByClassName("flaps")[0].style.transform = currentROT;

        var power = vindTilKW(MSW);
        var time = tid(MSW);

        //easy quick fix
        if (isNull) {
            time = 100000000;
            isNull = false;
        }
        
        TweenMax.to(obj, time, {directionalRotation: "+=360_cw", repeat: -1, ease: Linear.easeNone});



        if (MSW <= 3) {
            document.getElementById("powerSpan").innerHTML = "";
            output.innerHTML = "Ubrukelig";
        } else {
            document.getElementById("powerSpan").innerHTML = " kw";
            output.innerHTML = power;
        }
        if (MSW > 12) {
            document.getElementById("powerSpan").innerHTML = " kw";
            output.innerHTML = 3600;
        }
        document.getElementById("vindOutput").innerHTML = MSW;

    }

    function vindTilKW(vind) {
        var radius = 68;
        var tetthet = 1.23;
        var Cp = 0.28
        var areal = Math.PI * radius ^ 2;

        //rad.s
        var rad = 4 * Math.PI * vind / (3 * radius)
        var omdrS = rad / (2 * Math.PI);
        var omdrM = omdrS * 60;


        var effect = -2.1524 * Math.pow(vind, 4) + 56.814 * Math.pow(vind, 3) - 483.27 * Math.pow(vind, 2) + 1848.7 * vind - 2565.3;
        effect = Math.round(effect);

        var omdrTID = 1 / omdrS

        return effect;
    }

    function tid(vind) {
        if (vind == 0) {
            vind = 0.000001;

        }
        var radius = 68;
        
        var rad = 4 * Math.PI * vind / (3 * radius);
        var omdrS = rad / (2 * Math.PI);
        var omdrTID = 1 / omdrS;
        
        return omdrTID / multiplier;
    }
});