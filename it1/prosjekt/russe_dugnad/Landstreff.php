<!DOCTYPE html>
<?php
session_start();
ini_set('display_errors','0');
$Brukernavn=$_SESSION["Brukernavn"];
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="Russebudsjett.css">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bungee" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Russebudsjett - Landstreff</title>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTfjVQNHntBRWPIcHHW_gK8docVWg81zw"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <style>
    #content {
      margin: 0;
      padding: 0;
      width: 100%;
      margin-top: 20px;
    }
    .dropdown-content {
      background-color: transparent;
    }
    .info {
      color: black;
    }
    #scroller2 {
      cursor: pointer;
    }
    #loading {
      height: 100%;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #1b1b1b;
      z-index: 10;
      position: fixed;
      z-index: 50;
      left: 0;
      top: 0;
      font-size: 2rem;
    }
    .modal-content {
      color: white;
    }

    @media only screen and (max-width: 750px) {
      #content {
        margin-top: 0;
      }
    }
    </style>
  </head>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjVv5ZKVXYMwtmdgphhZ1YhY1eJ5vl4Cc&callback=i"></script>

          <script type="text/javascript">
              // When the window has finished loading create our google map below
              google.maps.event.addDomListener(window, 'load', init);

              function init() {
                  // Basic options for a simple Google Map
                  // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                  var mapOptions = {
                      // How zoomed in you want the map to start at (always required)
                      zoom: 12,

                      // The latitude and longitude to center the map (always required)
                      center: new google.maps.LatLng(58.969914, 5.733191), // New York

                      // How you would like to style the map.
                      // This is where you would paste any style found on Snazzy Maps.
                      styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
                  };

                  // Get the HTML DOM element that will contain your map
                  // We are using a div with id="map" seen below in the <body>
                  var mapElement = document.getElementById('map');

                  // Create the Google Map using our element and options defined above
                  var map = new google.maps.Map(mapElement, mapOptions);

                  // Let's also add a marker while we're at it
                  var marker = new google.maps.Marker({
                      position: new google.maps.LatLng(58.969914, 5.733191),
                      map: map,
                      title: 'Snazzy!'
                  });
              }
              </script>
  <body onload="window.location='#breaker'">
    <div id='loading'>Loading...</div>
  <?php include 'header.php'; ?>
<div id='content'>
  <div id="breaker">
    <h1 class="hero">Stavanger 5.-7. MAI 2017</h1>
    <div class="scroller"><img id="scroller" width="100px" heigth=""src="Assets/scroller.png" alt="Scroll buton, down arrow"></button></div>
  </div>

  <div id="overlay" class="map">
    <div id="map" style="width: 100%; height: 100vh;"></div>
  </div>
  <div id="breaker" class="second">
    <div class="video">
      <iframe  class="" src="https://player.vimeo.com/video/181481724" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    </div>

    <p class="desc" id="scroller2">LES MER UNDER!</p>
  </div>

<div class="info">
  <h2>Informasjon</h2>

      <p class="text">Det er flere hotellmuligheter i nærmiljøet. <a href="https://no.hotels.com/search.do?resolved-location=CITY%3A940258%3AUNKNOWN%3AUNKNOWN&destination-id=940258&q-destination=Stavanger,%20Norge&q-check-in=2017-05-05&q-check-out=2017-05-07&q-rooms=1&q-room-0-adults=2&q-room-0-children=0" target="_blank">Hotell i stavanger 5.-7.mai.</a></p>
      <h3>Podpad</h3>
      <p class="text">
        Den tradisjonelle podpaden er utstyrt med myke luftmadrasser i dobbelt- eller enkeltsenger, god bagasjeplass under sengene og lamper. Et solcellepanel på taket sørger for strømtilførsel, så man enkelt kan lade telefonen med billaderuttak. Hattehylle, speil og knagger gjør det mulig å holde styr på tingene dine, og med gardiner foran vinduene er det ikke obligatorisk å se soloppgang (med mindre du virkelig vil, da, eventuelt ikke har lagt deg enda.) Hyttene er låsbare, så vokt nøkkelen med livet ditt! Podpaden er klassisk og komfortabel - alt du trenger er sovepose!
        Kapasitet til to personer.
      </p>
      <h3>Artister</h3>
      <div>
        <li>Lars Vaular</li>
        <li>Filatov og Karas</li>
        <li>Unge Ferrari</li>
      </div>
</div>
<div class="fred">

    <h1>Fredriksten 21.–23. APRIL 2017</h1>
    <div class="video">
      <iframe  src="https://player.vimeo.com/video/182078149" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    </div>

    <a class='desc' href="http://www.landstreff-fredriksten.no/">Les mer på nettsiden!</a>
  </div>
</div>
  </body>
<?php

include 'footer.php';

?>
<script>
document.getElementsByClassName('nor')[0].setAttribute('src', 'Assets/a_norway.png');
document.getElementsByClassName('nor')[0].id = 'active';
document.getElementById('land').className = 'box active';
</script>
<script src="Russebudsjett.js"></script>
<script src="script.js" ></script>

</html>
