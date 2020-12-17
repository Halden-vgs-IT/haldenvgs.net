
  <?php
    session_start();
    include '../connection.php';
    ini_set('display_errors', '0');

    $Brukernavn=$_POST["Brukernavn"] ;;
    $Passord=$_POST["Passord"] ;
    $url=$_POST["videresend"];

    $SQL="SELECT `Passord` FROM `haldenvg_it`.`logginn` WHERE `Brukernavn`='$Brukernavn'";
    $resultat=$tilkobling->query($SQL);
    $pas=$resultat->fetch_assoc();
    if ($pas["Passord"]==md5($Passord)) {
    $SISTLOGGETINN=mysqli_query($tilkobling, "UPDATE `haldenvg_it`.`logginn` SET `Sistloggetinn`=NOW() WHERE `Brukernavn`='$Brukernavn'");
    session_start();
    echo "<script>window.history.back();</script>";
       $_SESSION["Brukernavn"] = $Brukernavn;
  }
    else {
    echo "<script>alert('Galt passord eller brukernavn')</script>";
    echo "<script>window.history.back();</script>";
  }

  ?>
