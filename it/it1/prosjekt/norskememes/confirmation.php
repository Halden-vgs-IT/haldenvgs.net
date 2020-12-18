<?php session_destroy() ?>
<!DOCTYPE html>
<html lang="no">
<head>
    <title>Sjekker passord ...</title>
    <?php
    $databaseHost = "31.220.21.90";
    $databaseUser = "haldenvg_norskeMemesAdmin";
    $databasePassword = "arildogjacob";
    $database = "haldenvg_norskeMemes";
    $connection = new mysqli($databaseHost, $databaseUser, $databasePassword, $database);
    if (mysqli_connect_error()) {
        echo "<script>alert('Could not connect to database')</script>";
        die();
    }
    $connection->set_charset("utf8");
    ?>
    <link type="text/css" rel="stylesheet" href="style.css">
    <script>

    </script>
</head>
<body>

<?php

$username=$_POST['username'];
$password=$_POST['password'];

$SQL = "SELECT * FROM haldenvg_norskeMemes.users WHERE username='$username'";
$result=$connection->query($SQL);
if (!$result) echo "<script>alert('Innlogging feilet. Prøv igjen.')</script>";
$data=$result->fetch_assoc();


if ($username===$data['username']) {
    if ($password===$data['password']) {
        session_start();
        $_SESSION["userID"] = $username;
        echo "<script>window.location.href='index.php'</script>";
    }
    else {
        echo "<script>alert('Feil passord.')</script>";
        echo "<script>window.history.back()</script>";
    }
}
else {
    echo "<script>alert('Feil brukernavn.')</script>";
    echo "<script>window.history.back()</script>";
}

?>

</body>
</html>