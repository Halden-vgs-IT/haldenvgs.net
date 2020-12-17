<!DOCTYPE HTML>
<html>
<body>
  <?php
    ini_set('display_errors', '0');
   include '../../connection.php';
    $Brukernavn=$_POST["Brukernavn"] ;
    $Tlfnr=$_POST["Tlfnr"] ;
    $Epost=$_POST["Epost"] ;
    $Passord=$_POST["Passord"] ;
    $Passord2=$_POST["Passord2"] ;

    if ($Passord != $Passord2) {
      echo "<script>alert('Vennligst kontroller passord')</script>";
      echo "<form action='../../Registrer.php' method='post' id='registrerform'>
      <input type='hidden' name='code' required='' value='gEjWGq6PCq' autocomplete='off'>
    </form>";
      echo "<script>document.getElementById('registrerform').submit();</script>";
      die() ;
    }

    $sjekkbruker=mysqli_query($tilkobling, "SELECT count(*) FROM `logginn` WHERE `Brukernavn` = '$Brukernavn'");
    while ($rad=$sjekkbruker->fetch_array())  {
      $exist=$rad[0];
    }
    if ($exist == 1) {
      echo "<script>alert('Brukernavn eksisterer allerede')</script>";
      echo "<form action='../../Registrer.php' method='post' id='registrerform'>
      <input type='hidden' name='code' required='' value='gEjWGq6PCq' autocomplete='off'>
    </form>";
      echo "<script>document.getElementById('registrerform').submit();</script>";
      die() ;
    }
    else {
    $SQL1="INSERT INTO `haldenvg_it`.`logginn` (`Brukernavn`,`Epost`,`Tlf`,`Passord`) VALUES ('$Brukernavn','$Epost','$Tlfnr',md5('$Passord'))";
    $SQL2="INSERT INTO `haldenvg_it`.`inntekt` (`Brukernavn`,`Inntekt`) VALUES ('$Brukernavn','0')";

    $lagret=$tilkobling->query($SQL1);
    $lagretinntekt=$tilkobling->query($SQL2);
    if ($lagret==true && $lagretinntekt == true) {
      echo "<script>window.location = '../../Bildevedregistrering.html'</script>";
      $SISTLOGGETINN=mysqli_query($tilkobling, "UPDATE `haldenvg_it`.`logginn` SET `Sistloggetinn`=NOW() WHERE `Brukernavn`='$Brukernavn'");
      session_start();
      $_SESSION["Brukernavn"] = $Brukernavn;

    }
    else {
      echo "<script>alert ('Kunne ikke registrere bruker')</script>";
      echo "<form action='../../Registrer.php' method='post' id='registrerform'>
      <input type='hidden' name='code' required='' value='gEjWGq6PCq' autocomplete='off'>
    </form>";
   echo "<script>document.getElementById('registrerform').submit();</script>";
      die();
    }
  }
  ?>
</body>
</html>
