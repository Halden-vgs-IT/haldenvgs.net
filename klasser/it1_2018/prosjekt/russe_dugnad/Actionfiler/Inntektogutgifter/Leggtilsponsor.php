
  <?php
  session_start();

  ini_set('display_errors', '0');

  include '../../connection.php';
    $Sponsor=$_POST["Sponsor"] ;
    $Sum=$_POST["Sum"] ;
    $Brukernavn=$_SESSION["Brukernavn"];


    $SQL1="INSERT INTO `haldenvg_it`.`sponsor` (`Sponsor`,`Sum`) VALUES ('$Sponsor','$Sum')";
    $lagret=$tilkobling->query($SQL1);
    if (!$lagret) {
    echo "<script>alert ('Kunne ikke legge til')</script>";
    die ();
    echo "<script>window.history.back();</script>";
  }
    else {
      echo "<script>window.history.back();</script>";
    }
    mysqli_query($tilkobling, "INSERT INTO `historikk` (`Brukernavn`,`Sum`,`Tid`,`Navn`,`Type`) VALUES ('$Brukernavn','$Sum',NOW(),'$Sponsor','6')");
  ?>
