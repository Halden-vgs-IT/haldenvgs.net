<!DOCTYPE html>

<html lang="no">

<head>

    <title>Setter opp ny bruker ...</title>

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

$email=$_POST['email'];

$password=$_POST['password'];

$passwordCon=$_POST['passwordCon'];



if (!($password==$passwordCon)) {

    echo "<script>alert('Du kan kun ha ett passord.')</script>";

    echo "<script>window.history.back()</script>";

}



$SQL = "INSERT INTO haldenvg_norskeMemes.users (`username`, `email`, `password`) VALUES ('$username', '$email', '$password')";

$result=$connection->query($SQL);

if (!$result) {

    echo "<script>alert('Registrering feilet. Prøv igjen.')</script>";

    echo "<script>window.location.back()</script>";

}

else {

    session_start();

    $_SESSION["newUser"] = $username;

    echo "<script>window.location.href = 'logIn.php'</script>";

}



?>



</body>

</html>