
  <?php
  session_start();
 ini_set('display_errors', '0');
include '../../connection.php';

    $Navn=$_POST["Item"] ;
    $Sum=$_POST["Sum"] ;
    $Kategori=$_POST["Kategori"];
    $Brukernavn=$_SESSION["Brukernavn"];


    $SQL1="INSERT INTO `haldenvg_it`.`budsjett` (`item`,`kategori`,`sum`) VALUES ('$Navn','$Kategori','$Sum')";
    $lagret=$tilkobling->query($SQL1);
    if (!$lagret) {
    echo "<script>alert ('Kunne ikke legge til')</script>";
    die();
    echo "<script>window.history.back();</script>";
  }
    else {
      echo "<script>window.history.back();</script>";
    }
    mysqli_query($tilkobling, "INSERT INTO `haldenvg_it`.`historikk` (`Brukernavn`,`Sum`,`Tid`,`Navn`,`Type`) VALUES ('$Brukernavn','$Sum',NOW(),'$Navn','13')");
  ?>
