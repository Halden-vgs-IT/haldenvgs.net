<!DOCTYPE html>

<html lang="no">

<head>

    <title>Norske Memes - Logg inn</title>

    <link rel="icon" href="pictures/favicon.png">

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.0/css/line.css">

    <script type="javascript" src="javascript.js"></script>

</head>

<body>

<main id="main-red">

    <div class="login-wrapper flexbox">

        <div id="form">

            <div class="form-left flexbox">

                <div class="form-left-overlay"></div>

            </div>

            <div class="form-right">

                <form class="form flexbox" method="post" action='confirmation.php' autocomplete="off">

                    <div class="form-inner">

                        <div class="form-title">Logg inn med brukeren din</div>

                        <div class="fii-wrapper">

                            <div class="form-input-wrapper">

                                <input class="form-input" id="name" type="text" name="username" value="" placeholder="Brukernavn" autocomplete="off" aria-label="" required>

                            </div>

                            <div class="form-input-wrapper">

                                <input class="form-input" type="password" id="password" name="password" value="" placeholder="Password" aria-label="" required>

                            </div>

                            <div class="btn-wrapper">

                                <button type="submit" value="submit" class="button btn-primary"><i class="uil uil-lock"></i> Logg Inn!<div class="btn-secondary"></div></button>

                            </div>

                            <div class="form-bottom flexbox">

                                <p>Ny bruker? <a href='signUp.php'>Registrer deg gratis!</a></p>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</main>

</body>

</html>