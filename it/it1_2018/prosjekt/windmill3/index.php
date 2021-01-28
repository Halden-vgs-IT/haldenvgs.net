<html lang="en">

<head>

    <meta charset="UTF-8">

    <link rel="stylesheet" href="style.css" type="text/css">

    <title>Vindmølleprosjekt</title>

    <script src="js.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/utils/Draggable.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>



<main>

    <div id="container">

        <div class="windmill">

            <div id="yellow"></div>

            <div id="red"></div>

            <div id="green"></div>

            <div class="pointer"></div>

        </div>

        <div class="poster"></div>

    </div>

    <div id="container1">

        <div class="windmill">

            <div id="yellow"></div>

            <div id="red"></div>

            <div id="green"></div>

            <div class="pointer"></div>

        </div>

        <div class="poster"></div>

    </div>

    <div id="container2">

        <div class="windmill">

            <div id="yellow"></div>

            <div id="red"></div>

            <div id="green"></div>

            <div class="pointer"></div>

        </div>

        <div class="poster"></div>

    </div>

    <div class="slider">

        <input id="range" type="range" min="0" max="15" value="0" oninput="rotate(this.value)" onchange="rotate(this.value)" title="">

        <p>Vindhastighet: <span id="val">0</span> m/s</p>

        <p>Strømuttak: <span id="out">0</span> kW</p>

        <output id="r" style="display:none">0</output>

    </div>

    <div class="planet">

        <div id="north"></div>

        <div id="west">

            <div id="building">

                <div class="windows">

                    <div class="light"></div>

                </div>

                <div class="windows">

                    <div class="light"></div>

                </div>

                <div class="windows">

                    <div class="light"></div>

                </div>

                <div class="windows">

                    <div class="light"></div>

                </div>

                <div class="windows">

                    <div class="light"></div>

                </div>

                <div id="door">

                    <div id="grip"></div>

                </div>

            </div>

            <div id="roof"></div>

        </div>

        <div id="south"></div>

        <div id="east"></div>

    </div>

    <h1 class="helene">I love you</h1>

</main>



</body>

</html>