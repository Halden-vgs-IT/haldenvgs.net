<?php
// Insert your own client ID here
$client_id = 'b9584c28-c9c4-45bc-8a13-dfea88845062';
date_default_timezone_set("CET");
// Build the URL and define parameters
$url = "https://" . $client_id . "@frost.met.no/observations/v0.jsonld";
//rakkestad
$url .= "?sources=" . "SN1380";
$url .= "&elements=" . "wind_speed";
$url .= "&referencetime=".date('Y-m-d');



// Replace spaces
$url = str_replace(" ", "%20", $url);
// Extract JSON data
$response = file_get_contents($url);
$response = json_decode($response, true);

if (array_key_exists('data', $response)) {
    $data = $response['data'];
} else {
    echo "Error: the data retrieval was not successful!";
}
// Loop through the data
foreach($data as $value) {
    $time = new DateTime($value['referenceTime']);
    $time = $time->format('Y-m-d');
    foreach($value['observations'] as $observation) {
        $element = $observation['elementId'];
        $value = $observation['value'];
        $offset = $observation['timeOffset'];
        $unit = $observation['unit'];
    }

}
if ($value == 0){
    $value = 0.1;
}

echo "
	<script>
	var value = $value;
	</script>
	";

?>
<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Vindmølle</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/utils/Draggable.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="icon" href="../images/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <main>
        <header>
            <h1 class="header-h1">Vindmølle</h1>
            <div class="menuwrapper">
                <input id="click" name="exit" type="checkbox" />
                <label for="click"><span class="burger"></span></label>
            </div>
            <div class="range-wrap">
                <?php echo "<input type='range' min='0' max='25' value='$value' step='0.01' class='range' id='myRange'>"; ?>
            </div>
        </header>
        <div class="sidenav">
            <div class="footer-txt-wrap">
                <p class="footer-p">Laget av </p><br/><br/>
                <div class="footer-a-wrap">
                    <a class="footer-a" href="https://instagram.com/areal_alien" target="_blank">Arild Edvin</a>
                </div><br/>
                <div class="footer-a-wrap">
                    <a class="footer-a" href="https://www.instagram.com/light_bringer_john/" target="_blank">Jonas Andre Have</a>
                </div>

				<div id="link-div">
					<p class="footer-a"> Live-Data taken from: </p>
					<a href="http://www.met.no"><img src="../images/met-logo.svg"> </a>
				</div>
			
			</div>



        </div>
        <div id="pictureframe">
            <div id="bird">
                <div id="body2"></div>
                <div id="body1"></div>
                <div id="wing-l"></div>
                <div id="wing-r"></div>
            </div>
        </div>
        <div class="cloud"></div>
        <div class="cloud"><div class="cloud2"></div></div>
        <div class="cloud-left"></div>
        <div class="cloud-right"></div>
        <div class="tree tree1">
            <div class="trunk">
                <div class="leftbranch"></div>
                <div class="rightbranch"></div>
            </div>
        </div>
        <div class="tree tree2">
            <div class="trunk">
                <div class="leftbranch"></div>
                <div class="rightbranch"></div>
            </div>
        </div>
        <div class="board1">
        <div class="plate1">
                <h3 class="board-txt" id="vindOutput"></h3><span class="board-txt"> m/s</span>
            </div>
            <div class="leg1"></div>
            <div class="leg2"></div>
        </div>
        <div class="bush">
            <div class="bush-part"></div>
            <div class="bush-part"></div>
            <div class="bush-part"></div>
        </div>
        <div class="bush-b">
            <div class="bush-part-b"></div>
            <div class="bush-part-b"></div>
            <div class="bush-part-b"></div>
        </div>
        <div id="windmill">
            <div class="post"></div>
            <div class="engine"></div>
            <div class="flaps">
                <div class="flap"></div>
                <div class="flap"></div>
                <div class="flap"></div>
            </div>
            <div class="head"></div>
        </div>
        <div class="board2">
            <div class="plate2">
                <h3 class="board-txt" id="powerOutput"></h3><span class="board-txt" id="powerSpan""> kw</span>
            </div>
            <div class="leg1"></div>
            <div class="leg2"></div>
        </div>
        <div class="bush2">
            <div class="bush-part2"></div>
            <div class="bush-part2"></div>
            <div class="bush-part2"></div>
        </div>
        <div class="bush-b2">
            <div class="bush-part-b2"></div>
            <div class="bush-part-b2"></div>
            <div class="bush-part-b2"></div>
        </div>
        <div class="tree tree3">
            <div class="trunk">
                <div class="leftbranch"></div>
                <div class="rightbranch"></div>
            </div>
        </div>
        <div class="sun"></div>
        <!-- <div class="moon"></div> -->
        <div class="level2 l1"></div>
        <div class="level3 l2"></div>
        <div class="level4 l3"></div>
        <div class="level"></div>
    </main>
    <footer>
        <div class="footer-txt-wrap">
            <p class="footer-p">Laget av </p>
            <div class="footer-a-wrap">
                <a class="footer-a" href="https://codepen.io/areal_alien" target="_blank">Arild Edvin</a>
            </div>
            <p class="footer-p-dot"> &#183 </p>
            <div class="footer-a-wrap">
                <a class="footer-a" href="https://codepen.io/areal_alien" target="_blank">Jonas Andre Have</a>
            </div>
        </div>
    </footer>
    <script src="../script/script.js"></script>

</body>
</html>