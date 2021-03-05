
  <?php
  session_start();
    ini_set('display_errors','0');

include '../../connection.php';

    $Navn=$_POST["dugnadnavn"] ;
    $Navnlowercase= strtolower($Navn);
    $Id=$_POST["dugnadid"];
    $Videresend=$_POST["videresend"];
    $Brukernavn=$_SESSION["Brukernavn"];

    $sjekkferdig=mysqli_query($tilkobling, "SELECT `Ferdig` FROM `dugnad` WHERE `navn`='$Navn'");
    while ($rad=$sjekkferdig->fetch_array()){
       $ferdig = $rad[0];
    }
    if ($ferdig==1){
      $hentinntekt =  mysqli_query($tilkobling, "SELECT `Inntekt` FROM `dugnad` WHERE `Navn` = '$Navn' ");
      while ($rad=$hentinntekt->fetch_array()){
        $Inntekt=$rad[0];
      }
      $hentantall = mysqli_query($tilkobling, "SELECT count(*) FROM `$Navnlowercase$Id` WHERE `Deltaker`='1'");
      while ($rad=$hentantall->fetch_array()){
        $antall=$rad[0];
      }
      $sumperpers=$Inntekt/$antall;
      $hentskal=mysqli_query($tilkobling, "SELECT `Id` FROM `haldenvg_it`.`$Navnlowercase$Id` WHERE `Deltaker`=1");
      while ($rad=$hentskal->fetch_assoc()){
          $hentidskal=$rad["Id"];
          $hentbrukernavn=mysqli_query($tilkobling, "SELECT `Brukernavn` FROM `haldenvg_it`.`logginn` WHERE `Id`='$hentidskal'");
          while ($rad=$hentbrukernavn->fetch_assoc()){
          $brukernavn=$rad['Brukernavn'];
          mysqli_query($tilkobling, "INSERT INTO `historikk` (`Brukernavn`,`Sum`,`Tid`,`Navn`,`Type`) VALUES ('$Brukernavn','-$sumperpers','NOW()','$dugnad','3')");
          $settinnsum=mysqli_query($tilkobling, "UPDATE `haldenvg_it`.`inntekt` SET `Inntekt` = `Inntekt`-'$sumperpers' WHERE `Brukernavn` = '$brukernavn'");
        //  $settinnhistorikk=mysqli_query($tilkobling, "INSERT INTO `haldenvg_it`.`historikk` (`Brukernavn`,`Sum`,`Tid`) VALUES ('$brukernavn','-$sumperpers', NOW())");
        }
      }
    }


    $SQL="DROP TABLE `haldenvg_it`.`$Navnlowercase$Id`";
    $SQL2="DELETE FROM `haldenvg_it`.`dugnad` WHERE `Id`='$Id'";

    $lagret=$tilkobling->query($SQL);
    $lagret2=$tilkobling->query($SQL2);
    if (!$lagret || !$lagret2) {
    echo "<script>alert('Kunne ikke slette dugnad')</script>";
    die();
    echo "<script>window.history.back();</script>";
    }
    else {
    echo "<script>window.history.back();</script>";
    }
    mysqli_query($tilkobling, "INSERT INTO `historikk` (`Brukernavn`,`Sum`,`Tid`,`Navn`,`Type`) VALUES ('$Brukernavn','',NOW(),'$Navn','3')");
  ?>
