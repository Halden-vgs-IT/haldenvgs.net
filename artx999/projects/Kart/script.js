document.getElementById("codeButton").onclick = function () {
    if (document.getElementById("code").style.display === "none") {
        document.getElementById("code").style.display = "block"
        document.getElementById("map").style.display = "none"
    }
    else {
        document.getElementById("code").style.display = "none"
        document.getElementById("map").style.display = "block"
    }
}