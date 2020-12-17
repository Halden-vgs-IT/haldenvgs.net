function rotate(value) {
    var V = value;
    var z = -2.1524 * V * V * V * V + 56.814 * V * V * V - 483.27 * V * V + 1848.7 * V - 2565.3;
    var objekter = [".windmill"];
    var R = 8-V * 0.5;
    var L = V * 0.1 - 0.3;
    if (V < 1) {
        R = 0;
    }
    if (V <= 3) {
        z = 0;
    }
    if (V > 12) {
        z = 3600;
    }
    if (V > 14) {
        R = 0.8
    }
    document.getElementById("val").innerHTML = V;
    document.getElementById("out").innerHTML = z.toFixed(2);
    document.getElementById("r").innerHTML = R;
    document.getElementsByClassName("light")[0].style.opacity = L;
    document.getElementsByClassName("light")[1].style.opacity = L;
    document.getElementsByClassName("light")[2].style.opacity = L;
    document.getElementsByClassName("light")[3].style.opacity = L;
    document.getElementsByClassName("light")[4].style.opacity = L;
    TweenMax.to(objekter,R,{directionalRotation: "+=360_cw", repeat:-1, ease:Power0.easeNone});

}
