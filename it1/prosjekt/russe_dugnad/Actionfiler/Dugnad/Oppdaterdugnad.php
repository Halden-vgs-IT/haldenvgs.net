<!DOCTYPE html>
<?php session_start();
  ini_set('display_errors', '0');
$Brukernavn=$_SESSION["Brukernavn"];
?>
  <?php
  include '../../connection.php';
    $eksnavn=$_POST["Tidligerenavn"];
    $tidligerenavn=strtolower($_POST["Tidligerenavn"]);
    $navn=$_POST["Navn"];
    $sted=$_POST["Sted"];
    $dato=$_POST["Dato"];
    $klokkeslett=$_POST["Klokkeslett"];
    $varighet=$_POST["Varighet"];
    $id=$_POST["dugnadid"];
    $dugnadnavn=strtolower($navn);

    $hentferdig=mysqli_query($tilkobling, "SELECT `ferdig` FROM `dugnad` WHERE `Id`='$id' ");
    while ($rad=$hentferdig->fetch_array()){
      $ferdig=$rad[0];
    }
    if ($ferdig==0){
  $lagret=  mysqli_query($tilkobling, "UPDATE `dugnad` SET `Navn`='$navn',`Sted`='$sted',`Dato`='$dato',`Klokkeslett`='$klokkeslett',`Varighet`='$varighet' WHERE `Id`='$id'");
    mysqli_query($tilkobling, "INSERT INTO `historikk` (`Brukernavn`,`Sum`,`Tid`,`Navn`,`Type`) VALUES ('$Brukernavn','',NOW(),'$navn','4')");
    mysqli_query($tilkobling, "RENAME TABLE `$tidligerenavn$id` TO `$dugnadnavn$id`");
    if (!$lagret) {
    echo "<script>alert('Dugnad ble ikke oppdatert')</script>";
    }
    else {
      echo "<script>window.history.back();</script>";
    }
  }
  elseif ($ferdig==1){
    $inntekt=$_POST["Inntekt"];
    $henteksinntekt=mysqli_query($tilkobling, "SELECT `Inntekt` FROM `dugnad` WHERE `Navn` = '$eksnavn'");
    $hentantall = mysqli_query($tilkobling, "SELECT count(*) FROM `$tidligerenavn$id` WHERE `Deltaker`=1");
    while ($rad=$hentantall->fetch_array()){
      $antall=$rad[0];
    }
    while ($rad=$henteksinntekt->fetch_array()){
      $eksinntekt=$rad[0];
    }
    $ekssumperpers=$eksinntekt/$antall;
    $sumperpers=$inntekt/$antall;
    $balanse=$sumperpers-$ekssumperpers;
    $hentskal=mysqli_query($tilkobling, "SELECT `Id` FROM `haldenvg_it`.`$tidligerenavn$id` WHERE `Deltaker`=1");
    while ($rad=$hentskal->fetch_assoc()){
        $hentidskal=$rad["Id"];
        $hentbrukernavn=mysqli_query($tilkobling, "SELECT `Brukernavn` FROM `haldenvg_it`.`logginn` WHERE `Id`='$hentidskal'");
        while ($rad=$hentbrukernavn->fetch_assoc()){
        $brukernavn=$rad['Brukernavn'];
        $settinnsum=mysqli_query($tilkobling, "UPDATE `haldenvg_it`.`inntekt` SET `Inntekt` = `Inntekt`+'$balanse' WHERE `Brukernavn` = '$brukernavn'");
        $oppdaterinntekt=mysqli_query($tilkobling, "UPDATE `haldenvg_it`.`historikk` SET `Sum` = '$sumperpers' WHERE `Brukernavn` = '$brukernavn' AND `Navn`='$tidligerenavn'");
        }
    }
    $lagret=
    mysqli_query($tilkobling, "UPDATE `dugnad` SET `Navn`='$navn',`Sted`='$sted',`Dato`='$dato',`Klokkeslett`='$klokkeslett',`Varighet`='$varighet', `Inntekt`='$inntekt' WHERE `Id`='$id'");
    mysqli_query($tilkobling, "INSERT INTO `historikk` (`Brukernavn`,`Sum`,`Tid`,`Navn`,`Type`) VALUES ('$Brukernavn','',NOW(),'$navn','4')");
    mysqli_query($tilkobling, "RENAME TABLE `$tidligerenavn$id` TO `$dugnadnavn$id`");

    if (!$lagret) {
    echo "<script>alert('Kunne ikke oppdatere dugnad')</script>";
    die();
    echo "<script>window.history.back();</script>";
    }
    else {
    echo "<script>window.history.back();</script>";
    }
}
  ?>
</body>
</html>
