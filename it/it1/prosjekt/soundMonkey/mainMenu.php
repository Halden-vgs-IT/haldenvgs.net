<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sound Monkey</title>
    <link type="text/css" rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.7/css/unicons.css">
    <script type="text/javascript" rel="script" src="javascript.js"></script>
    <style>
        body {
            background-color: var(--secondary-color);
        }
    </style>
</head>
<body>

<?php

if(isset($_POST["live"])) {
    echo "<div class=\"left\" onmouseover=\"hoverAlpha()\" onmouseout=\"hoverAlphaFalse()\" onclick=\"window.location.href='sensorA.php'\">";
    echo "<p class=\"alpha\" style=\"font-size: 15vw; color: #137B34\">&alpha;</p>";
    echo "</div>";
    echo "<div class=\"right\" onmouseover=\"hoverBeta()\" onmouseout=\"hoverBetaFalse()\" onclick=\"window.location.href='sensorB.php'\">";
    echo "<p class=\"beta\" style=\"font-size: 15vw; color: #333333\">&beta;</p>";
    echo "</div>";
}
else if (isset($_POST["archive"])) {
    echo "<div class=\"left\" onmouseover=\"hoverAlpha()\" onmouseout=\"hoverAlphaFalse()\" onclick=\"window.location.href='archiveA.php'\">";
    echo "<p class=\"alpha\" style=\"font-size: 15vw; color: var(--primary-color)\">&alpha;</p>";
    echo "</div>";
    echo "<div class=\"right\" onmouseover=\"hoverBeta()\" onmouseout=\"hoverBetaFalse()\" onclick=\"window.location.href='archiveB.php'\">";
    echo "<p class=\"beta\" style=\"font-size: 15vw; color: var(--main-bg-color)\">&beta;</p>";
    echo "</div>";
}
else {
    echo "<form method='post'>";
    echo "<button type='submit' name='live' class=\"left\" onmouseover=\"hoverLeft()\" onmouseout=\"hoverLeftFalse()\">";
    echo "<i class=\"uil uil-video\" style=\"font-size: 15vw; color: var(--primary-color)\"></i>";
    echo "</button>";
    echo "<button type='submit' name='archive' class=\"right\" onmouseover=\"hoverRight()\" onmouseout=\"hoverRightFalse()\">";
    echo "<i class=\"uil uil-folder\" style=\"font-size: 15vw; color: var(--main-bg-color)\"></i>";
    echo "</button>";
    echo "</form>";
}

?>

</body>
</html>
