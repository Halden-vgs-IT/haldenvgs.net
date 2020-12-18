
  <?php
  session_start();
  ini_set('display_errors', '0');

  include '../../connection.php';

    $Utgift=$_POST["Utgift"] ;
    $Kategori=$_POST["Kategori"];
    $Sum=$_POST["Sum"] ;
    $Brukernavn=$_SESSION["Brukernavn"];


    $SQL1="INSERT INTO `haldenvg_it`.`utgifter` (`Utgift`,`Kategori`,`Sum`) VALUES ('$Utgift','$Kategori','$Sum')";
    $lagret=$tilkobling->query($SQL1);
    if (!$lagret) {
    echo "<script>alert ('Kunne ikke legge til')</script>";
    die();
      echo "<script>window.history.back();</script>";
  }
    else {
      echo "<script>window.history.back();</script>";
    }
   mysqli_query($tilkobling, "INSERT INTO `historikk` (`Brukernavn`,`Sum`,`Tid`,`Navn`,`Type`) VALUES ('$Brukernavn','$Sum',NOW(),'$Utgift','9')");
  ?>
