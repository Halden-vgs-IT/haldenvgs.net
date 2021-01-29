
  <?php
  session_start();
  ini_set('display_errors', '0');

  include '../../connection.php';

    $Brukernavn=$_SESSION["Brukernavn"] ;
    $Sum=$_POST["Sum"] ;


    $SQL1="UPDATE `haldenvg_it`.`inntekt` SET `Inntekt` = `Inntekt`+'$Sum' WHERE `Brukernavn` = '$Brukernavn'";
    $lagret=$tilkobling->query($SQL1);
    if (!$lagret) {
    echo "<script>alert ('Kunne ikke legge til')</script>";
    die();
      echo "<script>window.history.back();</script>";
  }
    else {
      echo "<script>window.history.back();</script>";
    }
    mysqli_query($tilkobling, "INSERT INTO `historikk` (`Brukernavn`,`Sum`,`Tid`,`Navn`,`Type`) VALUES ('$Brukernavn','$Sum',NOW(),'','1')");

  ?>
