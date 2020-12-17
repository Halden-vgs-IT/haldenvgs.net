<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
     include 'connect.php';
     $hentnavn=mysqli_query($tilkobling, "SELECT `Navn` FROM `test` WHERE `Id`=1");
     while ($rad=$hentnavn->fetch_assoc()) {
       echo $rad["Navn"];
     }
     ?>
     <p>fungerer</p>
  </body>
</html>
