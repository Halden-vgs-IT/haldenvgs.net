<!DOCTYPE html>
<?php
session_start();
$Brukernavn = $_SESSION['Brukernavn'];
?>
<html>
<head>
  <meta charset="utf-8">
  <style>
  </style>
</head>
<body>
  <?php
   ini_set('display_errors', '0');

  include '../../connection.php';
  $imageName = mysqli_real_escape_string($tilkobling, $_FILES["image"]["name"]);
  $imageData = mysqli_real_escape_string($tilkobling, file_get_contents($_FILES["image"]["tmp_name"]));
  $imageType = mysqli_real_escape_string($tilkobling, $_FILES["image"]["type"]);
  $Type= substr($imageType,6) ;
  $videresend=$_POST["videresend"];
  $videresendhjem=$_POST["videresend2"];


  if ($Type == 'jpeg' || $Type == 'gif' || $Type == 'png' || $Type == 'jpg') {


    $sjekkbilde = mysqli_query($tilkobling, "SELECT count(*) FROM `profilbilde` WHERE `Brukernavn`='$Brukernavn'");
    $rad=$sjekkbilde->fetch_array();
  if ($rad[0] == 0) {
    $lagrebilde = "INSERT INTO `profilbilde` (`name`,`image`,`Brukernavn`) VALUES ('$imageName','$imageData','$Brukernavn')" ;
    $lagret=$tilkobling->query($lagrebilde);

      if (!$lagret==true || !isset($_SESSION['Brukernavn'])) {
        echo "<script>alert('Kunne ikke laste opp profilbilde')</script>";
        die();
        echo "<script>window.history.back();</script>";
      }
      else {
        echo "<script>window.location='$videresendhjem'</script>";
     }
  }
  elseif ($rad[0] == 1) {

   $oppdaterbilde = "UPDATE `profilbilde` SET `name`='$imageName',`image` = '$imageData' WHERE `Brukernavn`= '$Brukernavn'";
   $oppdatert=$tilkobling->query($oppdaterbilde);

     if (!$oppdatert==true) {
       echo "<script>alert('Kunne ikke oppdatere profilbilde')</script>";
       die();
       echo "<script>window.history.back();</script>";
     }
     else {
       echo "<script>window.location='$videresendhjem'</script>";
     }
  }
}
else {

  echo "<script>alert('Filformatet støttes ikke')</script>";
  echo "<script>window.history.back();</script>";
}
  ?>
</body>
</html>
