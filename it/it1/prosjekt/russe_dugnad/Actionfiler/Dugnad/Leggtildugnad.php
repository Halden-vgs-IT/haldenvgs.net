
  <?php
  session_start();
    ini_set('display_errors', '0');
  include '../../connection.php';

    $Navn=$_POST["Navn"] ;
    $Sted=$_POST["Sted"] ;
    $Dato=$_POST["Dato"] ;
    $Klokkeslett=$_POST["Klokkeslett"] ;
    $Varighet=$_POST["Varighet"] ;
    $Brukernavn=$_SESSION["Brukernavn"];
    $tabellnavn=strtolower($Navn);


    $SQL="INSERT INTO `haldenvg_it`.`dugnad` (`Navn`,`Sted`,`Dato`,`Klokkeslett`,`Varighet`) VALUES ('$Navn','$Sted','$Dato','$Klokkeslett','$Varighet')";
        $lagret=$tilkobling->query($SQL);
    $hentid=mysqli_query($tilkobling, "SELECT `Id` FROM `haldenvg_it`.`dugnad` WHERE `Navn`='$Navn' AND `Dato`='$Dato' AND `Klokkeslett`='$Klokkeslett'");
while ($rad=$hentid->fetch_array()) {
      $Id=$rad[0];
    }
    $SQL2="CREATE TABLE `haldenvg_it`.`$tabellnavn$Id` (`Id` INT(11) NOT NULL, `Deltaker` TINYINT(1) NOT NULL, PRIMARY KEY (`Id`))";
    $lagret2=$tilkobling->query($SQL2);
    if (!$lagret || !$lagret2) {
    echo "<script>alert('Dugnad ble ikke lagret')</script>";
     die();
     echo "<script>window.history.back();</script>";
    }
    else {
      echo "<script>window.history.back();</script>";
    }
    mysqli_query($tilkobling, "INSERT INTO `historikk` (`Brukernavn`,`Sum`,`Tid`,`Navn`,`Type`) VALUES ('$Brukernavn','',NOW(),'$Navn','2')");

  ?>
