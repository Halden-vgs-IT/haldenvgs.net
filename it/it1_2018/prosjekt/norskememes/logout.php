<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="no">
<head>
    <title>Norske Memes</title>
    <link rel="icon" href="pictures/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.0/css/line.css">
    <script type="javascript" src="javascript.js"></script>
</head>
<body>
<main>
    <div class="flexbox">
        <div class="btn-wrapper">
            <a href="index.php">
                <button type="submit" value="submit" class="button-blue btn-primary-blue">Forbli avlogget<div class="btn-secondary-blue"></div></button>
            </a>
        </div>
        <div class="btn-wrapper">
            <a href="logIn.php">
                <button type="submit" value="submit" class="button btn-primary">Logg inn på nytt<div class="btn-secondary"></div></button>
            </a>
        </div>
    </div>
</main>
</body>
</html>

