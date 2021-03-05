
  <?php
  session_start();
  ini_set('display_errors', '0');
  include '../../connection.php';

    $Navn=$_SESSION["Brukernavn"] ;

    $SQL="DELETE FROM `haldenvg_it`.`profilbilde` WHERE `Brukernavn`='$Navn'";

    $lagret=$tilkobling->query($SQL);
    if (!$lagret) {
      die();
      echo "<script>alert('Kunne ikke slette bilde')";
      echo "<script>window.history.back();</script>";
    }
    else {
      echo "<script>window.history.back();</script>";
    }
  ?>
