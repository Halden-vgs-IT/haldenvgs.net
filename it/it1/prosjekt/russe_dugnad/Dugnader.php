<!DOCTYPE HTML>
<?php
ini_set('display_errors', '0');
session_start();
$Brukernavn = $_SESSION['Brukernavn'];
?>
<html>
 <head>
   <link rel="stylesheet" type="text/css" href="Russebudsjett.css">
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
   <title>Russebudsjett - Dugnader</title>
   <style>
     #InfoModal {
       display: none;
       position: fixed;
       z-index: 4;
       left: 0;
       top: 0;
       width: 100%;
       height: 100%;
       overflow: auto;
       background-color: rgba(0,0,0,0.6);
     }
     #BildeModal {
       display: none;
       position: fixed;
       z-index: 4;
       left: 0;
       top: 0;
       width: 100%;
       height: 100%;
       overflow: auto;
       background-color: rgba(0,0,0,0.6);
     }
  </style>
</head>
<body >
<?php include 'header.php';?>
  <div id="content">
<?php
include 'connection.php';
  if (isset($_SESSION['Brukernavn'])) {
    echo "<button style='float: right;' href='' class='button'  id='Dugnadbtn' onclick='openaddmodal()'>Legg til dugnad</button>";
       echo "<div id='DugnadModal' class='modal'>
         <div class='modal-content'>
           <span class='close' onclick='closemodal()'>&times;</span>
           <div class='modalform'>
           <form id='skjema' action='Actionfiler/Dugnad/Leggtildugnad.php' method='POST'>
             <h2>Legg til dugnad</h2>
               <table>
                 <tr>
                   <td>Navn:</td>
                   <td><input type='text' name='Navn' required=''></td>
                 </tr>
                 <tr>
                   <td>Sted:</td>
                   <td><input  type='text' name='Sted' required=''></td>
                 </tr>
                 <tr>
                   <td>Dato:</td>
                   <td><input type='date' name='Dato' required=''></td>
                 </tr>
                 <tr>
                   <td>Klokkeslett:</td>
                   <td><input type='time' name='Klokkeslett' required=''></td>
                 </tr>
                 <td>Varighet:</td>
                 <td><input type='time' name='Varighet' required=''>
                 </td>
               </tr>
               <tr class='btncell'><td><br>
               <input class='button' id='send' type='submit' value='Legg til'>
              </td></tr>
              </table>
         </form>
       </div>
       </div>
     </div>";
     echo "<script>
     var addmodal = document.getElementById('DugnadModal');
     var addbtn = document.getElementById('Dugnadbtn');
     var span = document.getElementsByClassName('close')[1];

     function openaddmodal(){
     addmodal.style.display = 'block';
     }
    function closemodal() {
     addmodal.style.display = 'none';
     }
     addmodal.onclick = function(ev) {
           if(ev.target.className !== 'modal-content' && ev.target.className == 'modal'){
              addmodal.style.display = 'none';
           }
     }
     </script>";
}

  $sjekkdugnad = mysqli_query($tilkobling, "SELECT count(*) FROM `dugnad` WHERE `Ferdig`=0");
    while ($rad=$sjekkdugnad->fetch_array()){
      $antall=$rad[0];
    }
    echo "<h1> Kommende dugnader </h1>";
    echo "<div>";
     if ($antall>0){
       echo "<div class='dugnader'>";
       $SQL3="SELECT * FROM `haldenvg_it`.`dugnad` WHERE `Ferdig`=0 ORDER BY `Dato`";
       $resultat3=$tilkobling->query($SQL3) ;
         while ($rad=$resultat3->fetch_assoc()) {
           $id3=$rad["Id"];
           $navn3=$rad["Navn"] ;
           $Sted=$rad["Sted"] ;
           $date=$rad["Dato"];
           $Dato= date("d/m/Y", strtotime($rad["Dato"]));
           $Klokkeslett=date("H:i", strtotime($rad["Klokkeslett"]));
           $Varighet=$rad["Varighet"];
  echo "<div id='$id3' class='col-4 col-t-5 col-m-12'>";
  echo "<table class='dugnadtabell'>" ;
  echo "<tbody class='col-12'>";
  echo "<tr class='col-12'>" ;
  echo "<th class='col-12 col-m-12'>";
  if (isset($_SESSION['Brukernavn'])) {
  echo
  " <tr class='col-12'>
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
            <input type ='hidden' K' value='Dugnader.php'>
            <input style='font-size: 1.56rem;' id='subskal$id3'type='submit' value='&#x2713' onclick='' class='deleteupdatebutton'>
            </form></td>";
      echo "<td class='rad col-6'><form id='skalikke$id3' action='Actionfiler/Dugnad/Skalikke-dugnad.php' method='post' name='skalikke'>
              <input name='navn2' type='hidden' value='$Brukernavn' readonly>
              <input name='dugnad$id3' type='hidden' value='$navn3' readonly>
              <input name='dugnad' type='hidden' value='$navn3' readonly>
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
           echo "</div>";

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
                  <tr>
                  <td>Varighet:</td>
                  <td><input type='time' name='Varighet' value='$Varighet' ></td>
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
    }}
     echo "</div>";
  }
else {
  echo "<br><p>Ingen dugnader å vise</p>";
}
  echo "</div><br><br><br>";
     echo "<h1>Gjennomførte dugnader</h1><br><br>";

     $sjekkdugnad = mysqli_query($tilkobling, "SELECT count(*) FROM `dugnad` WHERE `Ferdig`=1");
       while ($rad=$sjekkdugnad->fetch_array()){
         $antall=$rad[0];
       }
       echo "<div>";
        if ($antall>0){
          echo "<div class='dugnader'>";
          $SQL3="SELECT * FROM `haldenvg_it`.`dugnad` WHERE `Ferdig`=1 ORDER BY `Dato` DESC";
          $resultat3=$tilkobling->query($SQL3) ;
            while ($rad=$resultat3->fetch_assoc()) {  //RAD
              $id3=$rad["Id"];
              $navn3=$rad["Navn"] ;
              $Sted=$rad["Sted"] ;
              $date=$rad["Dato"];
              $Dato= date("d/m/Y", strtotime($rad["Dato"]));
              $Klokkeslett=date("H:i", strtotime($rad["Klokkeslett"]));
              $Varighet=$rad["Varighet"];
              $Inntekt=$rad["Inntekt"];
     echo "<div id='$id3' class='col-4 col-t-5 col-m-12'>";
     echo "<table class='dugnadtabell'>" ;
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
    <button style='float: right;' href='' id='updatebtn$id3' class='deleteupdatebutton'  id='$id3'>&#x270E;</button></div></th></tr>";}
    echo "<tr class='col-12'>" ;
    echo "<th class='col-12 col-m-12'>";
     echo "<h2 class='navncelle'>$navn3</h2>";
     echo "</th>";
     echo "</tr>" ;

           echo "<tr class='col-12'><td class='rad col-12 col-m-12'>$Sted<br> $Dato kl. $Klokkeslett<br>Varighet: $Varighet</td> </tr>" ;
           echo "<tr class='col-12'><td class='rad col-6 col-m-6'style='vertical-align: top;'><h3>Deltok</h3>";
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
           echo "<td class='rad col-6 col-m-6'style='vertical-align: top;'><h3>Deltok ikke</h3>";
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
         echo "<tr class='col-12'>";
         echo "<td class='rad col-12 col-m-12' style='vertical-align: top;'><h3>Inntekt</h3><br>" ;
         echo "$Inntekt,-</td>";
         echo "</tr>";


           $hentid=mysqli_query($tilkobling, "SELECT `Id` FROM `logginn` WHERE `Brukernavn` = '$Brukernavn'");
           while ($rad = $hentid->fetch_assoc()) {
              $Id = $rad['Id'];
           }
           echo "</tbody>";
           echo "</table>" ;
           echo "</div>";
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
                     <td><input type='time' name='Varighet' value='$Varighet' ></td>
                   </tr>
                   <tr>
                   <td>Inntekt</td>
                   <td><input type='number' name='Inntekt' value='$Inntekt' >
                   </td>
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
       }}
           echo "</div><br><br>";
           }
else {
  echo "<p>Ingen dugnader å vise</p><br><br><br>";
}
  echo "</div>";

include 'footer.php';
?>
<script>
document.getElementsByClassName('work')[0].setAttribute('src', 'Assets/a_work.png');
document.getElementsByClassName('work')[0].id = 'active';
document.getElementById('dug').className = 'box active';
</script>
<script src="Russebudsjett.js"></script>
</body>
</html>
