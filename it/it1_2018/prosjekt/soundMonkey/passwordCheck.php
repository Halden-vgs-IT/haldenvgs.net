<?php

$host = "31.220.21.90";
$user = "haldenvg_soundMonkeyRead";
$password = "sugma";
$database = "haldenvg_soundMonkey";
$connection = new mysqli($host, $user, $password, $database);
if (mysqli_connect_error()) {
    echo "<script>alert('Could not connect to database')</script>";
    die();
}
$connection->set_charset("utf8");

$password=$_POST["password"];

$originalPassword="sugma";


if ($password==$originalPassword) {
    echo "<script>window.location.href = 'mainMenu.php'</script>";
}
else {
    echo "<script>alert('Galt passord')</script>";
    echo "<script>window.history.back()</script>";
}
