<!DOCTYPE HTML>
<?php
ini_set('display_errors', '0');
session_start();
$Brukernavn = $_SESSION['Brukernavn'];
?>
<html>
 <head>
   <meta name="viewport" content="width=device-width">
   <meta charset="utf-8">
   <title>Russebudsjett - Hjem</title>
   <link rel="stylesheet" type="text/css" href="Russebudsjett.css">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
   <script src="Russebudsjett.js"></script>
   <style>
   .historikk {
     padding-left: 7%;
   }
   @media only screen and (max-width: 700px) {
     .historikk {
       padding-left: 0;
     }
   }
  </style>
</head>
<body>
<?php
  include 'header.php';
?>
<div id="content">
<?php
  include 'connection.php';

 $SQL="SELECT * FROM `haldenvg_it`.inntekt;";
 $resultat=$tilkobling->query($SQL) ;
 echo "<div class='row'>";

    echo "<div class='col-6 col-m-12'>";
    echo "<h1>Inntekt</h1>";
    $sjekkdugnad = mysqli_query($tilkobling, "SELECT count(*) FROM `logginn`");
      while ($rad=$sjekkdugnad->fetch_array()){
         $antall=$rad[0];
      }
        if ($antall>0){
    echo "<table class='inntekttabell col-12' >" ;
    echo "<tr>" ;
    echo "<th class='tabellcelle'>Navn</th>" ;
    echo "<th class='tabellcelle'>Inntekt</th>" ;
    echo "</tr>" ;

      while ($rad=$resultat->fetch_assoc()) {
        $navn=$rad["Brukernavn"] ;
        $Sum=$rad["Inntekt"] ;
           echo "<tr>" ;
           echo "<td class='tabellcelle'>$navn</td>" ;
           echo "<td class='tabellcelle'>$Sum,-</td>" ;
           echo "</tr>" ;
      }
    echo "</table>" ;
    echo "</div>";
  }
  else {
    echo "<p>Ingen eksisterende brukere</p></div>";
    }

 $SQL2="SELECT * FROM `haldenvg_it`.`historikk` ORDER BY `Tid` DESC LIMIT 5";
 $resultat2=$tilkobling->query($SQL2) ;
 echo "<div class='col-6 col-t-6 col-m-12 historikk'>";
 echo "<h1>Historikk</h1>";
 $sjekkdugnad = mysqli_query($tilkobling, "SELECT count(*) FROM `historikk`");
   while ($rad=$sjekkdugnad->fetch_array()){
      $antall=$rad[0];
   }
     if ($antall>0){
     echo "<div class='col-12 col-t-12 col-m-12' style='margin-bottom: 10px;'>";

      while ($rad=mysqli_fetch_array($resultat2)) {
        $navn2=$rad["Brukernavn"] ;
        $Sum2=$rad["Sum"] ;
        $henttid=$rad["Tid"] ;
        $Tid2= date("d/m/Y H:i", strtotime($henttid));
        $Type=$rad["Type"];
        $element=$rad["Navn"];
        $sjekkbilde = mysqli_query($tilkobling, "SELECT count(*) FROM `profilbilde` WHERE `Brukernavn`='$navn2'");
        $row=$sjekkbilde->fetch_array();
      if ($row[0]==1){
        $hentpb=mysqli_query($tilkobling, "SELECT `image` FROM `haldenvg_it`.`profilbilde` WHERE `Brukernavn`='$navn2'");
           while ($rad=$hentpb->fetch_assoc()){
                 $pb = '<img src="data:image/jpeg;base64,'.base64_encode( $rad['image'] ).'" class="historikkpb">';
          }
      }
      elseif ($row[0]==0) {
                 $pb = "<img class='historikkpb' src='Assets/Defaultpb.jpg'>";
              }

        if ($Type==1){
            echo "
            <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
           $pb
           <div class='text'>
           <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 la til $Sum2,-</p>
           </div>
           </div></a>";
        }
        if ($Type==2){
             echo "
             <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
          $pb
            <div class='text'>
            <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 la til dugnaden $element</p>
            </div>
            </div></a>";
        }
        if ($Type==3){
          echo "
          <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
          $pb
         <div class='text'>
         <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 slettet dugnaden $element</p>
         </div>
         </div></a>";
        }
        if ($Type==4){
          echo "
         <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
         $pb
        <div class='text'>
        <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 oppdaterte dugnaden $element</p>
        </div>
        </div></a>";
        }
        if ($Type==5){
          echo "
          <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
         $pb
         <div class='text'>
         <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 la til $Sum2,- på dugnaden $element</p>
         </div>
         </div></a>";
        }
        if ($Type==6){
          echo "
          <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
          $pb
         <div class='text'>
         <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 la til $element som sponsor ($Sum2,-) </p>
         </div>
         </div></a>";
        }
        if ($Type==7){
          echo "
          <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
          $pb
         <div class='text'>
         <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 slettet sponsoren $element</p>
         </div>
         </div></a>";
        }
        if ($Type==8){
          echo "
          <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
          $pb
         <div class='text'>
         <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 endret utgiften $element til $Sum2,-</p>
         </div>
         </div></a>";
      }
        if ($Type==9){
          echo "
          <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
          $pb
         <div class='text'>
         <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 la til utgiften $element ($Sum2,-)</p>
         </div>
         </div></a>";
        }
        if ($Type==10){
          echo "
          <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
         $pb
         <div class='text'>
         <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 slettet utgiften $element ($Sum2,-)</p>
         </div>
         </div></a>";
        }
        if ($Type==11){
          echo "
          <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
         $pb
         <div class='text'>
         <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 endret sponsoren $element til $Sum2,- </p>
         </div>
         </div></a>";
        }
        if ($Type==12){
          echo "
          <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
          $pb
         <div class='text'>
         <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 tjente $Sum2,- på dugnaden $element</p>
         </div>
         </div></a>";
        }
        if ($Type==13){
          echo "
          <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
          $pb
         <div class='text'>
         <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 la til $element ($Sum2,-) i budsjettet</p>
         </div>
         </div></a>";
        }
        if ($Type==14){
          echo "
          <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
          $pb
         <div class='text'>
         <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 oppdaterte budsjettet. Endret $element til $Sum2,-</p>
         </div>
         </div></a>";
        }
        if ($Type==15){
          echo "
          <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
          $pb
         <div class='text'>
         <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 slettet $element ($Sum2,-) fra budsjettet</p>
         </div>
         </div></a>";
        }
      }
   echo "<a target='_self' class='button' href='Fullstendighistorikk.php' style='float: right;'>Fullstendig historikk</a>";
   echo "</div>";
   echo "</div>";
 }
 else {
   echo "<p>Ingen historikk</p></div>";
 }
   echo "</div>";
   echo "<h1>Kommende dugnader</h1>";
   echo "<div class='dugnader'>";
   $sjekkdugnad = mysqli_query($tilkobling, "SELECT count(*) FROM `dugnad` WHERE `Ferdig`=0");
     while ($rad=$sjekkdugnad->fetch_array()){
        $antall=$rad[0];
     }
       if ($antall>0){

         $SQL3="SELECT * FROM `haldenvg_it`.`dugnad` WHERE `Ferdig`=0 ORDER BY `Dato` LIMIT 3";
         $resultat3=$tilkobling->query($SQL3) ;
           while ($rad=$resultat3->fetch_assoc()) {
             $id3=$rad["Id"];
             $navn3=$rad["Navn"] ;
             $Sted=$rad["Sted"] ;
             $date=$rad["Dato"];
             $Dato= date("d/m/Y", strtotime($rad["Dato"]));
             $Klokkeslett=date("H:i", strtotime($rad["Klokkeslett"]));
             $Varighet=$rad["Varighet"];
    echo "<table class='dugnadtabell col-3 col-t-5 col-m-12'>" ;
    echo "<tbody class='col-12'>";
    if (isset($_SESSION['Brukernavn'])) {
    echo
    "<tr class='col-12'>
     <th class='col-12 col-m-12'>
    <div class='pbhover' style='float:right;'>
   <span class='navn-slett'>Slett</span>
    <form style='float: right; text-align: right;' action='Actionfiler/Dugnad/Slettdugnad.php' method='post'>
    <input value='$id3' type='hidden' name='dugnadid'>
    <input value='$navn3' type='hidden' name='dugnadnavn'>
    <input class='deleteupdatebutton' type='submit' value='&#x274C;'></form></div>
    <div class='pbhover' style='float:right;'>
   <span class='navn-rediger'>Rediger</span>
    <button style='float: right;' href='' id='updatebtn$id3' class='deleteupdatebutton'  id='$id3'>&#x270E;</button></div></th></tr>";
  }
  echo "<tr class='col-12'>" ;
  echo "<th class='col-12 col-m-12'>";
    echo "<h2 class='navncelle'>$navn3</h2>";
    echo "</th>";
    echo "</tr>" ;

          echo "<tr class='col-12'><td class='rad col-12 col-m-12'>$Sted<br> $Dato kl. $Klokkeslett<br>Varighet: $Varighet</td> </tr>" ;
          echo "<tr class='col-12'><td class='rad col-6 col-m-6'style='vertical-align: top;'><h3>Skal</h3>";
         echo "<br>";
          $dugnadnavn=strtolower($navn3);
          $hentskal=mysqli_query($tilkobling, "SELECT `Id` FROM `haldenvg_it`.`$dugnadnavn$id3` WHERE `Deltaker`=1");
          while ($rad=$hentskal->fetch_assoc()){
              $hentidskal=$rad["Id"];
              $hentnavnskal=mysqli_query($tilkobling, "SELECT `Brukernavn` FROM `haldenvg_it`.`logginn` WHERE `Id`='$hentidskal'");
                 while ($rad=$hentnavnskal->fetch_assoc()){
                    $hentbrukernavnskal=$rad["Brukernavn"];
                    $sjekkbilde = mysqli_query($tilkobling, "SELECT count(*) FROM `profilbilde` WHERE `Brukernavn`='$hentbrukernavnskal'");
                    $row=$sjekkbilde->fetch_array();
                if ($row[0]==1){
                    $hentpbskal=mysqli_query($tilkobling, "SELECT `image` FROM `haldenvg_it`.`profilbilde` WHERE `Brukernavn`='$hentbrukernavnskal'");
                       while ($rad=$hentpbskal->fetch_assoc()){
                             echo "<a class='pbhover' href='Profil.php?Brukernavn=$hentbrukernavnskal'>";
                             echo "<span class='navn' id='popup$hentbrukernavnskal'>$hentbrukernavnskal</span>";
                             echo '<img src="data:image/jpeg;base64,'.base64_encode( $rad['image'] ).'" class="bilde">';
                             echo "</a>";
                           }
                }
                           elseif ($row[0]==0) {
                             echo "<a class='pbhover' href='Profil.php?Brukernavn=$hentbrukernavnskal'>";
                             echo "<span class='navn' id='popup$hentbrukernavnskal'>$hentbrukernavnskal</span>";
                             echo "<img class='bilde' src='Assets/Defaultpb.jpg'>";
                             echo "</a>";
                          }
           }}

          echo "</td>" ;
          echo "<td class='rad col-6 col-m-6'style='vertical-align: top;'><h3>Skal ikke</h3>";
      echo "<br>" ;
          $hentskalikke=mysqli_query($tilkobling, "SELECT `Id` FROM `haldenvg_it`.`$dugnadnavn$id3` WHERE `Deltaker`=0");
          while ($rad=$hentskalikke->fetch_assoc()){
          $hentidskalikke=$rad["Id"];
          $hentnavnskalikke=mysqli_query($tilkobling, "SELECT `Brukernavn` FROM `haldenvg_it`.`logginn` WHERE `Id`='$hentidskalikke'");
          while ($rad=$hentnavnskalikke->fetch_assoc()){
             $hentbrukernavnskalikke=$rad["Brukernavn"];
             $sjekkbilde = mysqli_query($tilkobling, "SELECT count(*) FROM `profilbilde` WHERE `Brukernavn`='$hentbrukernavnskalikke'");
             $row=$sjekkbilde->fetch_array();
               if ($row[0]==1){
                  $hentpbskalikke=mysqli_query($tilkobling, "SELECT `image` FROM `haldenvg_it`.`profilbilde` WHERE `Brukernavn`='$hentbrukernavnskalikke'");
                      while ($rad=$hentpbskalikke->fetch_assoc()){
                        echo "<a class='pbhover' href='Profil.php?Brukernavn=$hentbrukernavnskalikke'>";
                        echo "<div class='navn'>$hentbrukernavnskalikke</div>";
                        echo '<img src="data:image/jpeg;base64,'.base64_encode( $rad['image'] ).'" class="bilde">';
                        echo "</a>";
                      }
                }
                elseif ($row[0]==0) {
                   echo "<a class='pbhover' href='Profil.php?Brukernavn=$hentbrukernavnskalikke'>";
                   echo "<div class='navn'>$hentbrukernavnskalikke</div>";
                   echo "<img class='bilde' src='Assets/Defaultpb.jpg'>";
                   echo "</a>";
                }
          }}

          echo "</td></tr>";

      if (isset($_SESSION['Brukernavn'])) {
        echo "<tr class='col-12'>";
        echo "<td class='rad col-12 col-m-12' style='vertical-align: top;'><h3>Inntekt</h3><br>" ;
        echo "<form action='Actionfiler/Dugnad/Dugnadinntekt.php' method='post'><input type='hidden' name='Brukernavn' value=$Brukernavn readonly>
              <input class='input' type='number' name='Inntekt' required>
              <input type='hidden' name='dugnadnavn' value='$navn3' required>
              <input type='hidden' name='Id' value='$id3' required>
              <input type='submit' value='Legg til' class='deleteupdatebutton'></form></td>";
        echo "</tr>";

        echo "<tr class='col-12'><td class='rad col-6'><form id='skal$id3' action='Actionfiler/Dugnad/Skal-dugnad.php' method='post' name='skal'>
              <input name='navn1' type='hidden' value='$Brukernavn' readonly>
              <input name='dugnad$id3' type='hidden' value='$navn3' readonly>
              <input name='dugnad' type='hidden' value='$navn3' readonly>
              <input type='hidden' name='Id' value='$id3' required>
              <input style='font-size: 1.56rem;' id='subskal$id3'type='submit' value='&#x2713' onclick='' class='deleteupdatebutton'>
              </form></td>";
        echo "<td class='rad col-6'><form id='skalikke$id3' action='Actionfiler/Dugnad/Skalikke-dugnad.php' method='post' name='skalikke'>
                <input name='navn2' type='hidden' value='$Brukernavn' readonly>
                <input name='dugnad$id3' type='hidden' value='$navn3' readonly>
                <input name='dugnad' type='hidden' value='$navn3' readonly>
                <input type='hidden' name='Id' value='$id3' required>
                <input style='font-size: 1.56rem;' id='subskalikke$id3' type='submit' value='&#x2717;' onclick='' class='deleteupdatebutton'>
              </form></td></tr>";

          $hentid=mysqli_query($tilkobling, "SELECT `Id` FROM `logginn` WHERE `Brukernavn` = '$Brukernavn'");
          while ($rad = $hentid->fetch_assoc()) {
             $Id = $rad['Id'];
          }

          //ENDRER KNAPPENE VED REGISTRERING OG GJØR DET MULIG Å OPPDATERE SKAL/SKAL IKKE
          $SQL4="SELECT `Deltaker` FROM `haldenvg_it`.`$dugnadnavn$id3` WHERE `Id`= '$Id'";
          $resultat4=$tilkobling->query($SQL4);
             while ($rad = $resultat4->fetch_assoc()) {
                  if ($rad['Deltaker']==1) {
                    echo "<script>document.getElementById('subskal$id3').style.color = '#41a043'</script>" ;
                    echo "<script>document.getElementById('subskalikke$id3').style.color = 'white'</script>";
                    echo "<script>document.getElementById('skalikke$id3').action = 'Actionfiler/Dugnad/Oppdaterskalikke-dugnad.php'</script>" ;
                    echo "<script>document.getElementById('skal$id3').action = 'Actionfiler/Dugnad/Oppdaterskal-dugnad.php'</script>";
                  }
                  if ($rad['Deltaker']==0) {
                    echo "<script>document.getElementById('subskal$id3').style.color = 'white'</script>";
                    echo "<script>document.getElementById('subskalikke$id3').style.color = '#fd5158'</script>" ;
                    echo "<script>document.getElementById('skal$id3').action = 'Actionfiler/Dugnad/Oppdaterskal-dugnad.php'</script>" ;
                    echo "<script>document.getElementById('skalikke$id3').action = 'Actionfiler/Dugnad/Oppdaterskalikke-dugnad.php'</script>";
                    }
             }}
          echo "</tbody>";
          echo "</table>" ;
            if (isset($_SESSION['Brukernavn'])) {
          echo "<div id='updateModal$id3' class='modal'>
            <div class='modal-content'>
              <span class='close$id3'>&times;</span>
              <div class='modalform'>
              <form id='skjema' action='Actionfiler/Dugnad/Oppdaterdugnad.php' method='POST'>
                <h2>Rediger dugnaden '$navn3'</h2>
                  <table>
                    <tr>
                      <td>Navn:</td>
                      <td><input type='text' name='Navn' value='$navn3' >
                      <input type='hidden' id='dugnadid' name='dugnadid' value='$id3'>
                      <input type='hidden' name='Tidligerenavn' value='$navn3'></td>
                    </tr>
                    <tr>
                      <td>Sted:</td>
                      <td><input  type='text' name='Sted' value='$Sted'></td>
                    </tr>
                    <tr>
                      <td>Dato:</td>
                      <td><input type='date' name='Dato' value='$date'></td>
                    </tr>
                    <tr>
                      <td>Klokkeslett:</td>
                      <td><input type='time' name='Klokkeslett' value='$Klokkeslett'></td>
                    </tr>
                    <td>Varighet:</td>
                    <td><input type='time' name='Varighet' value='$Varighet' >
                  </tr>
                 <tr class='btncell'><td><br>
                <input class='button' id='send' type='submit' value='Rediger'>
                </td></tr>
                </table>
            </form>
          </div>
          </div>
        </div>";
        echo "<script>
        var updatemodal$id3 = document.getElementById('updateModal$id3');
        var updatebtn$id3 = document.getElementById('updatebtn$id3')
        var span$id3 = document.getElementsByClassName('close$id3')[0];
        updatebtn$id3.onclick =function() {
          updatemodal$id3.style.display = 'block';
        }
        span$id3.onclick = function() {
        updatemodal$id3.style.display = 'none';
        }
        updatemodal$id3.onclick = function(ev) {
              if(ev.target.className !== 'modal-content' && ev.target.className == 'modal' ){
                 updatemodal$id3.style.display = 'none';
              }
        }
        </script>";
      }}}
    else {
      echo "<br><div class='col-12' style='text-align: left;'><p>Ingen dugnader å vise</p></div>";
    }

      echo "</div><br><br>";

      include 'footer.php';
?>
<script>
document.getElementsByClassName('home')[0].setAttribute('src', 'Assets/a_home.png');
document.getElementsByClassName('home')[0].id = 'active';
document.getElementById('hjem').className = 'box active';
</script>
<script src="Russebudsjett.js"></script>

</body>
</html>
