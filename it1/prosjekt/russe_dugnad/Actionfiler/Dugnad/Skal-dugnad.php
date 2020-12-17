<?php
  ini_set('display_errors', '0');
include '../../connection.php';

  $Navn=strtolower($_POST["dugnad"]);
  $Id1=mysqli_query($tilkobling, "SELECT `Id` FROM `dugnad` WHERE `Navn`='$Navn'");
  while ($rad = $Id1->fetch_assoc()){
     $iddugnad=$rad["Id"]; //30
  }
  $Brukernavn=$_POST["navn1"]; //Vegard
  $Id2=mysqli_query($tilkobling, "SELECT `Id` FROM `logginn` WHERE `Brukernavn`='$Brukernavn'");
   while ($rad2 = $Id2->fetch_assoc()){
     $idperson=$rad2["Id"]; //1
  }

  $lagret=mysqli_query($tilkobling, "INSERT INTO `haldenvg_it`.`$Navn$iddugnad` (`Id`,`Deltaker`) VALUES ('$idperson','1')");
  if (!$lagret) {
  echo "<script>alert('En feil oppstod')</script>";
  die();
  echo "<script>window.history.back();</script>";
  }
  else {
echo "<script>window.history.back();</script>";
  }

?>
