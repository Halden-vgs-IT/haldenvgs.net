<?php
  ini_set('display_errors', '0');
include '../../connection.php';
  $Navn=strtolower($_POST["dugnad"]);
  $Id1=mysqli_query($tilkobling, "SELECT `Id` FROM `dugnad` WHERE `Navn`='$Navn'");
  while ($rad = $Id1->fetch_assoc()){
     $iddugnad=$rad["Id"];
  }
  $Brukernavn=$_POST["navn2"];
  $Id2=mysqli_query($tilkobling, "SELECT `Id` FROM `logginn` WHERE `Brukernavn`='$Brukernavn'");
   while ($rad2 = $Id2->fetch_assoc()){
     $idperson=$rad2["Id"];
  }

  $SQL="UPDATE `haldenvg_it`.`$Navn$iddugnad` SET `Deltaker`='0' WHERE `Id`='$idperson'";


  $lagret=$tilkobling->query($SQL);
  if (!$lagret) {
  echo "<script>alert('En feil oppstod')</script>";
  die();
  echo "<script>window.history.back();</script>";
  }
  else {
echo "<script>window.history.back();</script>";
  }

?>
