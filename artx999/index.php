<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="HTML,CSS,JavaScript,PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Picker</title>
    <link rel="icon" href="icon.png">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/jquery.color-animation/1/mainfile"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.0/css/line.css">
</head>
<body>
<main>
    <div id="propChooser">
        <h1>How will your layout be?</h1>
        <form>
            <div class="gridBlock">
                <label for="seatHeight">Height:</label>
                <input type="number" class="number" id="seatHeight" max="16">
            </div>
            <div class="gridBlock">
                <!-- Empty For Now -->
            </div>
            <div class="gridBlock">
                <label for="seatWidth">Width:</label>
                <input type="number" class="number" id="seatWidth" max="16">
            </div>
            <div id="buttonWrapper">
                <button id="goToSeatChart" class="button btn-primary" type="button">Next <i class="uil uil-angle-right-b"></i><div class="btn-secondary"></div></button>
            </div>
        </form>
    </div>
    <div id="seatChart">
        <h1>Pick your seats</h1>
        <div class="inner">
            <div class="left"></div>
            <div class="right">
                <form>
                    <div class="gridBlock">
                        <label for="howMany">How many?</label>
                        <input id="howMany" placeholder="0" type="number">
                    </div>
                    <div id="blacklistBtn" class="gridBlock2">
                        <button id="black" class="button btn-primary" type="button">Whitelist</button>
                    </div>
                </form>
                <div>
                    <div class="buttonWrapper2">
                        <button id="start" class="button btn-primary" type="button">Start <i class="uil uil-angle-right-b"></i><div class="btn-secondary"></div></button>
                    </div>
                    <div class="buttonWrapper2">
                        <button id="red" class="button btn-primary" type="button">Exit <i class="uil uil-times"></i><div id="redSec" class="btn-secondary"></div></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="easterEgg">
        <button></button>
        <video controls>
            <source src="greetings.mp4" type="video/mp4">
        </video>
    </div>
    <p id="source"></p>
</main>
</body>
<script src="script.js"></script>
</html>
