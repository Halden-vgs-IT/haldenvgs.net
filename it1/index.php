<!DOCTYPE html>
<html lang="no">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="HTML,CSS,JavaScript,PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ======= -->
    <!-- General -->
    <title>Halden VGS</title>
    <link rel="icon" href="images/favicon-vgs.svg">
    <!-- ===== -->
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:700" rel="stylesheet">
    <!-- ======= -->
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://unicons.iconscout.com/release/v3.0.0/script/monochrome/bundle.js"></script>
    <!-- =========== -->
    <!-- Stylesheets -->
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/buttons.css">
    <link rel="stylesheet" href="css/pace-theme-minimal.tmpl.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.0/css/line.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.0/css/solid.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>

    <!-- Loading - Pace -->
    <div class="pace">
        <div class="pace-progress"></div>
    </div>

    <!-- Main Page -->
    <main id="main">

        <nav id="navbar" class="flexbox">
            <div id="nav-button">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="nav-items-wrapper flexbox-right">

            </div>
        </nav>

        <div id="menu" class="flexbox-col">
            <a href="index.php">Hjem.</a>
            <a href="pages/prosjekter.php">Prosjekter.</a>
            <a href="pages/info.php">Info.</a>
        </div>

        <!-- header -->
        <header id="header" class="flexbox">
            <div class="header-content flexbox">
                <h1 class="header-title"><span>Halden</span> vgs</h1>
            </div>
            <div class="header-overlay"></div>
            <img class="header-img" src="https://images.unsplash.com/photo-1563206767-5b18f218e8de?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1949&q=80" alt="">
        </header>

        <!-- Page -->
        <div id="page" class="flexbox-col">

            <div class="top-bar flexbox-col">
                <div class="flexbox-col-left">
                    <h1 class="top-bar-title">Elev nettsider</h1>
                    <p class="top-bar-text">Dette er en samling av nettsider som er laget av elever ved Halden videregående skole.</p>
                </div>
                <div class="btn-wrapper btn-space">
                    <a href="pages/info.php"><button class="button3 btn-primary3"><i class="uil uil-map-marker-info"></i> Info<div class="btn-secondary3"></div></button></a>
                </div>
            </div>

            <div class="page-inner">

                <div id="forskning">
                    <div class="image-wrapper">
                        <div class="title-wrapper flexbox">
                            <h1 class="title">Forskningsprosjekt</h1>
                        </div>
                        <div class="image-overlay"></div>
                        <img class="image" src="images/prosjekter/forskningsprosjekt/img.png" alt="">
                    </div>
                    <div class="info">
                        <h3>Forskningsprosjekt <span>TEK 2</span></h3>
                        <p>Nettsiden er laget av Elevene i TEK 2</p>
                        <div class="content">
                            <div class="btn-wrapper btn-space flexbox-left">
                                <a href="https://www.haldenvgs.net/it1/prosjekt/forskningsprosjekt/" target="_blank"><button class="button3 btn-primary3"><i class="uil uil-angle-right"></i> Åpne<div class="btn-secondary3"></div></button></a>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>
                <div id="vindmølle">
                    <div class="image-wrapper">
                        <div class="title-wrapper flexbox">
                            <h1 class="title">Vindmølle</h1>
                        </div>
                        <div class="image-overlay"></div>
                        <img class="image" src="images/prosjekter/vindmølle/img.png" alt="">
                    </div>
                    <div class="info">
                        <h3>Vindmølle <span>Frisk luft</span></h3>
                        <p>Nettsiden er laget av Arild Edvin og Jonas Have.</p>
                        <div class="content">
                            <p>Funksjonell vindmølle laget i HTML, CSS og Javascript.</p>
                            <div class="btn-wrapper btn-space flexbox-left">
                                <a href="https://haldenvgs.net/prosjekt/windmill/php/index.php" target="_blank"><button class="button3 btn-primary3"><i class="uil uil-angle-right"></i> Åpne<div class="btn-secondary3"></div></button></a>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>
                <div id="soundmonkey">
                    <div class="image-wrapper">
                        <div class="title-wrapper flexbox">
                            <h1 class="title">soundMonkey</h1>
                        </div>
                        <div class="image-overlay"></div>
                        <img class="image" src="images/prosjekter/soundmonkey/img.png" alt="">
                    </div>
                    <div class="info">
                        <h3>soundMonkey <span>Masse data</span></h3>
                        <p>Nettsiden er laget av Jacob Gomez og Mathias René</p>
                        <div class="content">
                            <p>soundMonkey er en lydmåler som plottes i en graf og vises visuelt på nettsiden</p>
                            <div class="btn-wrapper btn-space flexbox-left">
                                <a href="https://haldenvgs.net/prosjekt/soundMonkey/index.php" target="_blank"><button class="button3 btn-primary3"><i class="uil uil-angle-right"></i> Åpne<div class="btn-secondary3"></div></button></a>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>
                <div id="homedrone">
                    <div class="image-wrapper">
                        <div class="title-wrapper flexbox">
                            <h1 class="title">Homedrone</h1>
                        </div>
                        <div class="image-overlay"></div>
                        <img class="image" src="images/prosjekter/homedrone/img.png" alt="">
                    </div>
                    <div class="info">
                        <h3>Homedrone</h3>
                        <p>Nettsiden er laget av August Birkeland, Vemund Frydenlund og Vemund Refnin.</p>
                        <div class="content">
                            <p>Dette er en presentasjon av en egenprodusert drone.</p>
                            <div class="btn-wrapper btn-space flexbox-left">
                                <a href="https://www.psi-gruppen.no/hd/html/index.html" target="_blank"><button class="button3 btn-primary3"><i class="uil uil-angle-right"></i> Åpne<div class="btn-secondary3"></div></button></a>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>
                <div id="norskeMemes">
                    <div class="image-wrapper">
                        <div class="title-wrapper flexbox">
                            <h1 class="title">Norske Memes</h1>
                        </div>
                        <div class="image-overlay"></div>
                        <img class="image" src="images/prosjekter/norskeMemes/img.PNG" alt="">
                    </div>
                    <div class="info">
                        <h3>Norske Memes <span>Under utvikling</span></h3>
                        <p>Nettsiden er laget av Jacob Gomez Hansen og Arild Edvin Andreassen</p>
                        <div class="content">
                            <p>Norske memes er et sosialt medie der man enkelt kan se og lage memes.</p>
                            <div class="btn-wrapper btn-space flexbox-left">
                                <a href="https://haldenvgs.net/prosjekt/norskememes/index.php" target="_blank"><button class="button3 btn-primary3"><i class="uil uil-angle-right"></i> Åpne<div class="btn-secondary3"></div></button></a>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>

                <div class="btn-wrapper btn-space flexbox">
                    <a href="pages/prosjekter.php"><button class="button3 btn-primary3"><i class="uil uil-folder-open"></i> Alle prosjekter<div class="btn-secondary3"></div></button></a>
                </div>

            </div>

            <footer id="footer" class="flexbox">

                <div class="footer-inner flexbox-col">
                    <div class="footer-top">

                    </div>
                    <div class="footer-bottom flexbox-space">
                        <div class="footer-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" viewBox="0 0 512 512">
                                <defs>
                                    <clipPath id="clip-favicon">
                                        <rect width="512" height="512"/>
                                    </clipPath>
                                </defs>
                                <g id="favicon" clip-path="url(#clip-favicon)">
                                    <g id="Group_1" data-name="Group 1" transform="translate(-150.872 -134.91)">
                                        <path id="Path_6" data-name="Path 6" d="M.81,1.9V211.784c.362,99.1,79,221.148,204.407,291.833,125.455-70.685,204.1-192.73,204.2-291.833V1.9Z" transform="translate(201.375 138.125)" fill="#fff"/>
                                        <path id="Path_7" data-name="Path 7" d="M0,.91.258,215.083C.362,316.2,80.606,440.572,208.593,512.91,336.58,440.572,416.824,316.2,416.978,215.083V.91ZM208.593,418.1c-38.8,0-70.22-7.441-70.22-10.334s31.415-10.334,70.22-10.334,70.427,7.957,70.427,10.592S247.4,418.1,208.593,418.1Zm0-53.892c-59.576,0-107.939-10.851-107.939-15.5s48.363-15.5,107.939-15.5,107.939,10.851,107.939,15.5S268.22,364.2,208.593,364.2Zm0-62.676c-73.165,0-132.482-13.383-132.482-18.963S135.428,263.6,208.593,263.6s132.431,13.383,132.431,18.963S281.809,301.527,208.593,301.527Zm137.6-80.812c-16.173,3.255-76.627,8.267-137.649,8.267s-121.993-5.167-137.6-8.267a1.4,1.4,0,0,1-1.5-1.808A396.931,396.931,0,0,1,206.681,39.4a3.255,3.255,0,0,1,3.824,0,396.568,396.568,0,0,1,137.236,179.5C348.1,219.888,347.275,220.508,346.19,220.715Z" transform="translate(198 134)" fill="#231f20"/>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="footer-smalltext">
                            <a href="https://halden.vgs.no/" target="_blank">Halden videregående skole.</a>
                        </div>
                    </div>
                </div>

            </footer>

        </div>

    </main>

</body>
<script>
    paceOptions = {
        elements: true
    };
</script>
<script src="javascript/pace.js"></script>
<script src="javascript/script.js"></script>
</html>