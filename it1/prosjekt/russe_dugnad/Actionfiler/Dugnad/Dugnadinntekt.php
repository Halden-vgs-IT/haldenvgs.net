  <?php
  session_start();
  ini_set('display_errors', '0');
  include '../../connection.php';
    $Inntekt=$_POST["Inntekt"];
    $dugnad=$_POST["dugnadnavn"];
    $Id=$_POST["Id"];
    $dugnadnavn=strtolower($dugnad);
    $Brukernavn=$_SESSION["Brukernavn"];
    $SQL="UPDATE `haldenvg_it`.`dugnad` SET `Inntekt`= '$Inntekt',`Ferdig`=1 WHERE `Id` = '$Id'";
    $lagret=$tilkobling->query($SQL);
    $dugnadnavn=strtolower($dugnad);
    $hentantall = mysqli_query($tilkobling, "SELECT count(*) FROM `$dugnadnavn$Id` WHERE `Deltaker`='1'");
    while ($rad=$hentantall->fetch_array()){
      $antall=$rad[0];
    }
    $sumperpers=$Inntekt/$antall;
    $hentskal=mysqli_query($tilkobling, "SELECT `Id` FROM `haldenvg_it`.`$dugnadnavn$Id` WHERE `Deltaker`=1");
    while ($rad=$hentskal->fetch_assoc()){
        $hentidskal=$rad["Id"];
        $hentbrukernavn=mysqli_query($tilkobling, "SELECT `Brukernavn` FROM `haldenvg_it`.`logginn` WHERE `Id`='$hentidskal'");
        while ($rad=$hentbrukernavn->fetch_assoc()){
        $brukernavn=$rad['Brukernavn'];
        $settinnhistorikk = mysqli_query($tilkobling, "INSERT INTO `historikk` (`Brukernavn`,`Sum`,`Tid`,`Navn`,`Type`) VALUES ('$brukernavn','$sumperpers',NOW(),'$dugnad','12')");
         $settinnsum=mysqli_query($tilkobling, "UPDATE `haldenvg_it`.`inntekt` SET `Inntekt` = `Inntekt`+'$sumperpers' WHERE `Brukernavn` = '$brukernavn'");

    }}
    mysqli_query($tilkobling, "INSERT INTO `historikk` (`Brukernavn`,`Sum`,`Tid`,`Navn`,`Type`) VALUES ('$Brukernavn','$Inntekt',NOW(),'$dugnad','5')");
    if (!$lagret || !$settinnhistorikk || !$settinnsum) {
      echo "<script>alert('Kunne ikke legge til inntekt')</script>";
      die();
      echo "<script>window.history.back();</script>";
      }
      else {
      echo "<script>window.history.back();</script>";
      }


  ?>
