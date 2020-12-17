<html>
<head>
  <meta charset="utf-8">
</head>
<body>
  <?php
  session_start();
    ini_set('display_errors', '0');

  include '../../connection.php';


    $Tidligerenavn=$_SESSION["Brukernavn"];
    $Tidligerepassord=$_POST["Forrigepassord"] ;
    $Brukernavn=$_POST["Navn"] ;
    $Tlfnr=$_POST["Tlfnr"] ;
    $Epost=$_POST["Epost"] ;
    $Passord=$_POST["Passord"] ;
    $Passord2=$_POST["Passord2"] ;

    if ($Passord != $Passord2) {
      echo "<script>alert('Vennligst kontroller passord')</script>";
      echo "<script>window.location = '../../Profil.php?Brukernavn=$Tidligerenavn'</script>";
      die() ;
    }
    $sjekkbruker=mysqli_query($tilkobling, "SELECT count(*) FROM `logginn` WHERE `Brukernavn` = '$Brukernavn'");
    while ($rad=$sjekkbruker->fetch_array())  {
      $exist=$rad[0];
    }
    if ($exist == 1 && $Brukernavn != $Tidligerenavn) {
      echo "<script>alert('Brukernavn eksisterer allerede')</script>";
      echo "<script>window.history.back();</script>";
      die() ;
    }
    else {

    $SQL="SELECT `Passord` FROM `haldenvg_it`.`logginn` WHERE `Brukernavn`='$Tidligerenavn'";
    $resultat=$tilkobling->query($SQL);
    $pas=$resultat->fetch_assoc();
    if ($pas["Passord"]==md5($Tidligerepassord)) {

      $SQL1="UPDATE `haldenvg_it`.`logginn` SET `Brukernavn`='$Brukernavn',`Epost`='$Epost',`Tlf`='$Tlfnr',`Passord`=md5('$Passord') WHERE `Brukernavn`='$Tidligerenavn'";
      $SQL2="UPDATE `haldenvg_it`.`inntekt` SET `Brukernavn`='$Brukernavn' WHERE `Brukernavn`='$Tidligerenavn'";
      $SQL3="UPDATE `haldenvg_it`.`profilbilde` SET `Brukernavn`='$Brukernavn' WHERE `Brukernavn`='$Tidligerenavn'";
      $SQL4="UPDATE `haldenvg_it`.`historikk` SET `Brukernavn`='$Brukernavn' WHERE `Brukernavn`='$Tidligerenavn'";

      $lagret=$tilkobling->query($SQL1);
      $lagretinntekt=$tilkobling->query($SQL2);
      $lagretbilde=$tilkobling->query($SQL3);
      $lagrethistorikk=$tilkobling->query($SQL4);
        if (!$lagret) {
          echo "<script>alert ('Kunne ikke oppdatere info')</script>";
          die();
          echo "<script>window.history.back();</script>";
        }
        else {
        echo "<script>alert('Vennligst logg inn på nytt')</script>";
        echo "<script>window.location ='../../Hjem.php'</script>";
        session_destroy();
        session_start();
        $Brukernavn = $SESSION["Navn"];
      }
  }
  else {
  echo "<script>alert ('Feil passord')</script>";
  echo "<script>window.history.back()</script>"; }
}
  ?>
</body>
</html>
