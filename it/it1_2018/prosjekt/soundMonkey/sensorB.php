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

    <title>Sensor B</title>

    <link rel="stylesheet" href="style.css">

    <script rel="script" type="text/javascript" src="javascript.js"></script>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <script>

        window.onload = function timeLoop() {

            var i = 0;

            var test = [{y: 1}];

            window.setInterval(function () {

                i = (i + 1);

                m = Math.floor((Math.random() * 100) + 1);

                test.push({y: m});

                if (i >= 100) {

                    test.slice();

                }else{

                    test.push({y: m});

                }

                var chart = new CanvasJS.Chart("chartContainer", {

                    animationEnabled: false,

                    theme: "light2",

                    title:{

                        text: "Simple Line Chart"

                    },

                    axisY:{

                        includeZero: true

                    },

                    data: [{

                        type: "line",

                        dataPoints: test

                    }]

                });

                chart.render();



            }, 1);

        };

    </script>

</head>

<body>

<div id="chartContainer"></div>

<button id="demo" onclick="chartFunction()">Trykk på meg</button>

</body>

</html>