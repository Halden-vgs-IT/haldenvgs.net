<?php
$host = "31.220.21.90";
$user = "haldenvg_soundMonkeyRead";
$password = "sugma";
$database = "haldenvg_soundMonkey";
$connection = new mysqli($host, $user, $password, $database);
if (mysqli_connect_error()) {
    echo "<script>alert('Could not connect to database')</script>";
    die();
}
$connection->set_charset("utf8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sensor A</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <script rel="script" type="text/javascript" src="javascript.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
        window.onload = function timeLoop() {
            var i = 0;
            var test=[{y: 1}];
            var sum=[1];
            window.setInterval(function () {
                m = Math.floor((Math.random() * 100) + 1);
                if (i >= 100) {
                    i = (i + 1);
                    document.getElementById("chartContainer").style.width = i + "%";
                    test.push({y: m});
                }else{
                    test.push({y: m});
                    i = (i + 1);
                }
                sum.push(m);
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: false,
                    theme: "light2",
                    title:{
                        text: "DesiBel values",
                    },
                    axisY:{
                        includeZero: true
                    },
                    data: [{
                        type: "line",
                        color: "var(--secondary-color)",
                        dataPoints: test
                    }]
                });
                chart.render();

                var average = sum.reduce((a, b) => a + b, 0) / sum.length || 0;
                document.getElementById("avg").innerHTML = "Average: " + average.toFixed(2);
                document.getElementById("time").innerText = "Time passed: " + i + " sec";
            }, 1000);
        };
    </script>
</head>
<body>
<div id="chartContainer"></div>
<div id="info">
    <div id="avg">Average: </div>
    <div id="time">Time passed: </div>
</div>


</body>
</html>
