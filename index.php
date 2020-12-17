<!DOCTYPE html>
<html lang="no">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ======= -->
    <!-- General -->
    <title>Halden VGS - IT2</title>
    <link rel="icon" href="it1/images/favicon-vgs.svg">
    <!-- ===== -->
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- ======= -->
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.4.2/gsap.min.js"></script>
    <script src="https://unicons.iconscout.com/release/v3.0.3/script/monochrome/bundle.js"></script>
    <script src="javascript/rellax.min.js"></script>
    <script src="javascript/rellax.js"></script>
    <!-- =========== -->
    <!-- Stylesheets -->
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1462889/unicons.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.3/css/line.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.3/css/solid.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>

    <!-- Main -->
    <main class="flexbox">

        <div class="media flexbox-col-left">

            <h1 class="title">Halden VGS</h1>
            <p class="undertitle">Hjemmesiden til haldenvgs er midlertidig flyttet til <a href="https://www.haldenvgs.net/it1">haldenvgs.net/it1</a></p>

            <div class="button-wrapper">
                <a href="https://www.haldenvgs.net/it1">
                    <button type="button" class="button btn-primary"><i class="uil uil-corner-down-right-alt"></i> Gå til hjemmesiden<div class="btn-secondary"></div></button>
                </a>
            </div>

        </div>

        <div class="overlay"></div>
        <div class="image-wrapper flexbox">
            <video id="header-video" loop autoplay preload="auto">
                <source src="Stars.m4v" type="video/mp4">
            </video>
        </div>
        <!--<div class="image-wrapper flexbox">
            <img src="https://images.unsplash.com/photo-1516566697885-aee1cea47319?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1950&q=80" alt="">
        </div>-->

    </main>

</body>
<script>

    // Video playing with timeout
    let vid = document.querySelector("#header-video");
    vid.autoplay = true;
    vid.volume = 0;
    vid.load();

</script>
<script src="javascript/script.js"></script>
</html>