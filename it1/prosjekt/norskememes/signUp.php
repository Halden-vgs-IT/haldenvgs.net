<!DOCTYPE html>
<html lang="no">
<head>
    <title>Norske Memes - Lag ny bruker</title>
    <link rel="icon" href="pictures/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.0/css/line.css">
    <script type="javascript" src='javascript.js'></script>
</head>
<body>
<main id="main-blue">
    <div class="login-wrapper flexbox">
        <div id="form">
            <div class="form-left-blue flexbox">
                <div class="form-left-overlay"></div>
            </div>
            <div class="form-right">
                <form class="form flexbox" method="post" action="registration.php" autocomplete="off">
                    <div class="form-inner">
                        <div class="form-title">Lag ny bruker</div>
                        <div class="fii-wrapper">
                            <div class="form-input-wrapper">
                                <input class="form-input" id="nameReg" type="text" name="username" value="" placeholder="Brukernavn" autocomplete="off" aria-label="" required>
                            </div>
                            <div class="form-input-wrapper">
                                <input class="form-input" id="emailReg" type="text" name="email" value="" placeholder="E-postadresse" autocomplete="off" aria-label="" required>
                            </div>
                            <div class="form-input-wrapper">
                                <input class="form-input" type="password" id="passwordReg" name="password" value="" placeholder="Passord" aria-label="" required>
                            </div>
                            <div class="form-input-wrapper">
                                <input class="form-input" type="password" id="passwordRegCon" name="passwordCon" value="" placeholder="Bekreft passord" aria-label="" required>
                            </div>
                            <div class="btn-wrapper">
                                <button type="submit" value="submit" class="button-blue btn-primary-blue"><i class="uil uil-key-skeleton-alt"></i> Lag ny bruker!<div class="btn-secondary-blue"></div></button>
                            </div>
                            <div class="form-bottom2 flexbox">
                                <p>Allerede registrert? <a href="logIn.php">Logg inn!</a></p>
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