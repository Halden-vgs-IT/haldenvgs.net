<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Kart</title>
    <link type="text/css" rel="stylesheet" href="style.css">
    <link type="text/css" rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>
<body>
<main>
    <div id="map"></div>
    <button id="codeButton">Code</button>
    <div id="code"><xmp><!DOCTYPE html>
            <html lang="no">
            <head>
                <meta charset="UTF-8">
                <title>Kart</title>
                <link type="text/css" rel="stylesheet" href="style.css">
                <link type="text/css" rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
                <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
            </head>
            <body>
            <main>
                <div id="map"></div>
                <button id="codeButton"></button>
                <div id="code"></div>
            </main>
            </body>
            <script>
                var map = L.map('map').setView([59.119628, 11.398631], 14);
                L.tileLayer('https://opencache.statkart.no/gatekeeper/gk/gk.open_gmaps?layers=topo4&zoom={z}&x={x}&y={y}', {
                    attribution: "<a href='http://www.kartverket.no/'>Kartverket</a>"
                }).addTo(map);
                var home = L.marker([59.096052, 11.396214]).addTo(map); home.bindPopup("Hjemme")
                var fortress = L.marker([59.119628, 11.398631]).addTo(map); fortress.bindPopup("Festningen")
            </script>
            </html></xmp></div>
</main>
</body>
<script>
    var map = L.map('map').setView([59.119628, 11.398631], 14);
    L.tileLayer('https://opencache.statkart.no/gatekeeper/gk/gk.open_gmaps?layers=topo4&zoom={z}&x={x}&y={y}', {
        attribution: "<a href='http://www.kartverket.no/'>Kartverket</a>"
    }).addTo(map);
    var home = L.marker([59.096052, 11.396214]).addTo(map); home.bindPopup("Hjemme")
    var fortress = L.marker([59.119628, 11.398631]).addTo(map); fortress.bindPopup("Festningen")
</script>
<script src="script.js"></script>
</html>