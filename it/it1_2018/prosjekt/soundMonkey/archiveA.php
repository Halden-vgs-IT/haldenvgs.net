<!DOCTYPE html>

<html lang="en">

<head>

    <title>Archive Sensor A</title>

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

    ?>

    <link type="text/css" rel="stylesheet" href="style.css">

    <script>



    </script>

</head>



<body>

<?php



if (isset($_POST["tableSubmit"])) {

    $tableName2=$_POST["name"];

    echo "<h1>Date and time of recording: $tableName2</h1>";

    $SQL = "SELECT * FROM `$tableName2`";

    $result=$connection->query($SQL);

    if (!$result) echo "<script>alert('The data was not gathered')</script>";

    $a = array();

    $i = 0;

    echo "<table>";

    echo "<tr>";

    echo "<th>Intervals</th>";

    echo "<th>dB</th>";

    echo "</tr>";

    while ($row=$result->fetch_assoc()) { 

        $interval=$row["Interval"];

        $dB=$row["dB"];

        $a[]=$row['dB'];

        echo "<tr>";

        echo "<th>$interval</th>";

        echo "<th>$dB</th>";

        echo "</tr>"; 



    }

    echo "</table>";

    $average = round(array_sum($a) / count($a), 2);

    echo "<div class='databaseInfo'>";

    echo "<div id='avgArchive'>Average: $average dB</div>";

    echo "<div>This is a test</div>";

    echo "<div>This is another test</div>";

    echo "</div>";

}

else {

    $SQL = "SELECT table_name FROM information_schema.tables WHERE TABLE_TYPE = 'BASE TABLE'";

    $res=$connection->query($SQL);

    if (!$res) echo "<script>alert('Dataene ble ikke hentet 2')</script>";

    while ($table=$res->fetch_assoc()) {

        $tableName=$table["table_name"];

        echo "<form method='post' class=\"tableList\">";

        echo "<button type='submit' name='tableSubmit' class='table'>";

        echo "<p class=\"alpha\">$tableName;</p>";

        echo "<input type='hidden' name='name' value='$tableName'>";

        echo "</button>";

        echo "</form>";

    }

}



?>

</body>

</html>