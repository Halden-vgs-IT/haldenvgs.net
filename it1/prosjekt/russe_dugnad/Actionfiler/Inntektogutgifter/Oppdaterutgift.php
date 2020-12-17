
  <?php
  session_start();
    ini_set('display_errors', '0');

  include '../../connection.php';

    $id=$_POST["Id"];
    $sum=$_POST["Sum"];
    $item=$_POST["Item"];
    $Brukernavn=$_SESSION["Brukernavn"];


    $SQL=mysqli_query($tilkobling, "UPDATE `haldenvg_it`.`utgifter` SET `Sum`='$sum' WHERE `Id`='$id'");
     mysqli_query($tilkobling, "INSERT INTO `historikk` (`Brukernavn`,`Sum`,`Tid`,`Navn`,`Type`) VALUES ('$Brukernavn','$sum',NOW(),'$item','8')");


           if (!$SQL) {
             echo "<script>alert('Kunne ikke oppdatere')</script>";
             die();
            echo "<script>window.history.back();</script>";
           }
           else {
             echo "<script>window.history.back();</script>";
          }
  ?>
