<!DOCTYPE HTML>
<?php
session_start();
ini_set('display_errors', '0');
$Bruker = $_SESSION["Brukernavn"];
$Navn = $_GET['Brukernavn'];
?>
<html>
 <head>
   <meta name="viewport" content="width=device-width">
   <link rel="stylesheet" type="text/css" href="Russebudsjett.css">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

 <style>
 html body {
   text-align: center;
   padding: 0;
   margin: 0;
 }
 #navn {
   margin-top: 0;
 }
 a .deleteupdatebutton {
   text-decoration: none;
   font-family: raleway;
 }
 img {
   width: 100%;
 }
 #dropdownprofil {
   font-size: 1.2rem;
   width: 160px;
   position: absolute;
   z-index: 2;
 }
 #profildropdowncontent {
   text-align: left;
   display: none;
}
 #historikk {
   display: none;
   margin-top: 40px;
 }
 #dropdownalt {
   font-size: 1.2rem;
 }
#dropdownalt:hover {
   cursor: pointer;
 }
 #Tekst {
   margin-top: 40px;
 }
   .pb {
     height: 190px;
     width: 190px;
     display: inline-block;
     padding: 0;
  }
  .relative {
    position: relative;
  }
     #info {
       display: inline-block;
       vertical-align: top;
       margin-left: 1%;
       text-align: left;
     }
     #content {
       width: 100%;
     }
     #profil {
       padding: 0;
     }
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
       text-align: left!important;
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
       text-align: center!important;
     }
     footer {
       text-align: left;
     }
     .pb:hover #Bildebtn {
       visibility: visible;
     }
     #info:hover #Infobtn {
       visibility: visible;
     }
     #Bildebtn {
       position: absolute;
       left: 0;
       background-color: rgba(0,0,0,0.6);
       visibility: hidden;
     }
     #Infobtn {
      float: right;
      display: flex;
      align-items: center;
      visibility: hidden;
    }
    .historikk {
      display: none;
    }
    #filvalgt {
      font-size: 0.8rem;
    }
     [id^=updateModal], [id$=Modal] {
       text-align: left!important;
     }
     @media only screen and (max-width: 700px){
       .pb {
         margin: 5px 5px 20px 5px;
       }
       #info {
         margin: 0;
       }
     }
     @media only screen and (max-width: 330px) {
       #filvalgt {
         font-size: 0.7rem;
       }
     }
     @media only screen and (max-width: 950px) {
       #Infobtn, #Bildebtn {
         visibility: visible;
       }
     }

 </style>
   <meta charset="utf-8">
   <?php echo "<title>Russebudsjett - $Navn </title>"; ?>
   <link rel="stylesheet" type="text/css" href="Russebudsjett.css">
</head>
<body id="body">
<?php include 'header.php'; ?>
  <div id="content">
<?php
$url=$_SERVER['REQUEST_URI'];
include 'connection.php';

   $sjekkbruker = mysqli_query($tilkobling, "SELECT count(*) FROM `logginn` WHERE `Brukernavn`='$Navn'");
   $rad=$sjekkbruker->fetch_array();
   if ($rad[0] == 0) {
     echo "<p>Bruker eksisterer ikke</p>";
   }
   else {
   $hentinfo=mysqli_query($tilkobling, "SELECT `Epost`,`Tlf`,`Sistloggetinn` FROM `logginn` WHERE `Brukernavn`='$Navn' ");
   while($rad=$hentinfo->fetch_assoc()){
     $epost=$rad['Epost'];
     $tlfnr=$rad['Tlf'];
     $hentdato=$rad["Sistloggetinn"];
     $sistloggetinn= date("d/m/Y H:i", strtotime($hentdato));
   }
   $hentbilde="SELECT `image` FROM `haldenvg_it`.`profilbilde` WHERE `Brukernavn`='$Navn'";
   $var=$tilkobling->query($hentbilde);
     while($row=$var->fetch_assoc()) {
       $pb=$row['image'];
      }
   $hentinntekt = mysqli_query($tilkobling,"SELECT `Inntekt` FROM `inntekt` WHERE `Brukernavn`='$Navn'");
     while ($row=$hentinntekt->fetch_assoc()){
       $inntekt = $row['Inntekt'];
     }
?>
<script>
function checkfile() {
  var file = document.getElementById("fileToUpload").value;
  var filename = file.slice(12);
  var text = document.getElementById("filvalgt")

text.innerHTML = filename;
}
</script><br>
  <div id="profil" class='col-12'>
  <?php
    $sjekkbilde = mysqli_query($tilkobling, "SELECT count(*) FROM `profilbilde` WHERE `Brukernavn`='$Navn'");
    $rad=$sjekkbilde->fetch_array();
    if ($Navn == $Bruker) {
    if ($rad[0] == 0) {
      echo "<div class='pb' style='position: relative;'>";
       echo "<img src='Assets/Defaultpb.jpg'>";
      echo "<div class='pbhover' id='Bildebtn'><span class='navn-rediger'>Oppdater</span>
         <button style='float: right;' href='' class='deleteupdatebutton' >&#x270E;</button></div></div>";
    }
    elseif ($rad[0] == 1) {
      echo "<div class='pb' style='position: relative;'>";
       echo '<img src="data:image/jpeg;base64,'.base64_encode( $pb ).'" >';
        echo "<div class='pbhover' id='Bildebtn'><span class='navn-rediger'>Oppdater</span>
         <button style='float: right;' href='' class='deleteupdatebutton' >&#x270E;</button></div></div>";
    }}
    else {
      if ($rad[0] == 0) {
        echo "<img src='Assets/Defaultpb.jpg' class='pb'>";
      }
      elseif ($rad[0] == 1) {

         echo '<img src="data:image/jpeg;base64,'.base64_encode( $pb ).'" class="pb">';
      }

    }?>
  <div id="info">
    <?php
    if ($Navn == $Bruker)  {
      echo "
   <h1 id='navn'>$Navn
  <div class='pbhover' id='Infobtn'><span class='navn-rediger'>Oppdater</span>
   <button  href='' class='deleteupdatebutton' >&#x270E;</button></div>
 </h1>";
 }
 else {
   echo "<h1 id='navn'>$Navn</h1>";
 }
 ?>
  <p>Sist logget inn: <?php echo $sistloggetinn ?></p>
  <p>Epost: <?php echo $epost?></p>
  <p>Tlf: <?php echo $tlfnr?></p>
  <p>Inntekt: <?php echo "$inntekt,-"?></p><br><br>
</div>
<?php

if ($Navn == $Bruker) {
  echo "<div id='InfoModal' class='modal'>
  <div class='modal-content'>
    <span class='close' onclick='closeinfo()'>&times;</span>
    <div class='modalform'>
    <form  id='skjema' action='Actionfiler/Profil/Oppdaterprofil.php' method='post'>
      <h2>Oppdater profil</h2>
        <table style='text-align: left;'>
          <tr>
            <td>Tidligere passord:</td>
            <td><input type='password' name='Forrigepassord' required=''></td>
          </tr>
          <tr>
            <td>Navn:</td>
            <td><input type='text' name='Navn' required='' value='$Navn'></td>
          </tr>
          <tr>
            <td>Telefonnummer:</td>
            <td><input  type='text' name='Tlfnr' required='' value='$tlfnr'></td>
          </tr>
          <tr>
            <td>Epost:</td>
            <td><input type='text' name='Epost' required='' value='$epost'></td>
          </tr>
          <tr>
            <td>Passord:</td>
           <td><input  type='password' name='Passord' required=''></td>
          </tr>
          <tr>
            <td>Gjenta passord:</td>
            <td><input  type='password' name='Passord2' required=''></td>
          </tr>
      <tr class='btncell'><td><br>
      <input class='button'  type='submit' value='Oppdater'>
      </td></tr></table>
    </form>
  </div>
  </div>
</div>";

echo "<div id='BildeModal' class='modal'>
<div class='modal-content'>
  <span class='close' onclick='closepic()'>&times;</span>
   <h2>Oppdater profilbilde</h2><br>
  <div class='modalform'>
  <div style='display: inline; '>
  <form style='display: inline;' action='Actionfiler/Profil/Lastoppbilde.php' enctype='multipart/form-data' method='post'>
  <input type='hidden' name='videresend2' value='../../Profil.php?Brukernavn=$Navn'>
              <label class='button'><input type='file' name='image' id='fileToUpload' onchange='checkfile()'>Velg fil</label>
              <p style='display: inline;' id='filvalgt'>Ingen fil valgt</p>&emsp;&emsp;
              <input class='button' type='submit' value='Last opp'><br><br>
  </form>
  </script>
  <form  style='display: inline;'action='Actionfiler/Profil/Slettbilde.php' method='post'>
  <input type='hidden' name='brukernavn' value='$Navn'>
   <input class='button' type='submit' value='Slett gjeldende bilde'>
  </form>
  </div>
</div>
</div>
</div>";

echo "<script>
  var infomodal = document.getElementById('InfoModal');
  var infobtn = document.getElementById('Infobtn');
  var bildebtn = document.getElementById('Bildebtn');
  var bildemodal = document.getElementById('BildeModal');
  var span1 = document.getElementsByClassName('close')[1];
  var span2 = document.getElementsByClassName('close')[2];
  infobtn.onclick = function() {
  infomodal.style.display = 'block';
  }
  function closeinfo() {
  infomodal.style.display = 'none';
  }
  bildebtn.onclick = function() {
  bildemodal.style.display = 'block';
  }
  function closepic() {
  bildemodal.style.display = 'none';
  }
  bildemodal.onclick = function(ev) {
        if(ev.target.className !== 'modal-content' && ev.target.className == 'modal' ){
           bildemodal.style.display= 'none';
        }
  }
  infomodal.onclick = function(ev) {
        if(ev.target.className !== 'modal-content' && ev.target.className == 'modal' ){
           infomodal.style.display= 'none';
        }
  }
</script>";
}

$hentid = mysqli_query($tilkobling, "SELECT `Id`  FROM `haldenvg_it`.`logginn` WHERE `Brukernavn`='$Navn'");
while ($rad=$hentid->fetch_assoc()) {
  $idpers=$rad['Id'];
}?>
<div id='dropdownprofil'  style='text-align: left' onmouseover="showalt()" onmouseout="hidealt()">
  <div style='display: block'>
  <a id='profildropdown'>Siste dugnader <img id="arrow" src="Assets/dropdown.png" alt="Pil ned"></a>
</div>
  <div id='profildropdowncontent' style='margin-left: 0; margin-top: 0; width: 152px; background-color: #1b1b1b;'>
    <a id='dropdownalt' onclick='profildropdown()' onmouseover="hover()" onmouseout="unhover()">Historikk</a>
  </div>
</div><br><br>

<?php
echo "<p id='Tekst' style='text-align: left; padding-left: 10px;'></p>";
echo "<div class='dugnader col-12' id='dugnader'>";

$SQL="SELECT * FROM `haldenvg_it`.`dugnad`";
$resultat=$tilkobling->query($SQL) ;

while ($rad=$resultat->fetch_assoc()){
  $Inntekt=$rad['Inntekt'];
  $dugnadid=$rad["Id"];
  $Navn=$rad["Navn"] ;
  $Sted=$rad["Sted"] ;
  $Dato=$rad["Dato"];
  $Klokkeslett=substr($rad["Klokkeslett"],0,-8) ;
  $Varighet=$rad["Varighet"];
  $dugnadnavn=strtolower($Navn);


  $sjekkdeltaker=mysqli_query($tilkobling, "SELECT * FROM `haldenvg_it`.`$dugnadnavn$dugnadid`");
  while ($rad=$sjekkdeltaker->fetch_assoc()){
    $Id = $rad["Id"];
    $Deltaker=$rad["Deltaker"];

      if ($Id==$idpers && $Deltaker==1){
      $sjekkferdig=mysqli_query($tilkobling, "SELECT `Ferdig` FROM `haldenvg_it`.`dugnad` WHERE `Navn`='$Navn'");
      while ($rad=$sjekkferdig->fetch_array()){
        $ferdig=$rad[0];
      }
      if ($ferdig==1){
      $SQL4="SELECT * FROM `haldenvg_it`.`dugnad` WHERE `Navn`='$Navn' AND `Ferdig`=1 ORDER BY `Dato` DESC LIMIT 3";
      $resultat4=$tilkobling->query($SQL4) ;
      while ($rad=$resultat4->fetch_assoc()) {
        $id3=$rad["Id"];
        $navn3=$rad["Navn"] ;
        $Sted=$rad["Sted"] ;
        $date = $rad["Dato"];
        $Dato= date("d/m/Y", strtotime($rad["Dato"]));
        $Klokkeslett=date("H:i", strtotime($rad["Klokkeslett"]));
        $Varighet=substr($rad["Varighet"],0,-8) ;
        $Inntekt=$rad["Inntekt"];
        echo "<table class='dugnadtabell col-3 col-t-5 col-m-12'>" ;
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
              $hentskal=mysqli_query($tilkobling, "SELECT `Id` FROM `haldenvg_it`.`$dugnadnavn$dugnadid` WHERE `Deltaker`=1");
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
              $hentskalikke=mysqli_query($tilkobling, "SELECT `Id` FROM `haldenvg_it`.`$dugnadnavn$dugnadid` WHERE `Deltaker`=0");
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
              echo "</tr><br>";
            }
       echo "</table>";
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
                 <td><input type='number' name='Inntekt' value='$Inntekt' ></td>
               </tr>
               <tr class='btncell'><td><br>
               <input class='button' id='send' type='submit' value='Registrer'>
               </td></tr></table>
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
   }

     }}}}}
  echo "</div>";

  echo "<div class='col-12 col-t-12 col-m-12 historikk' id='historikk'>";
  echo "<div class='col-12 col-t-12 col-m-12' style='margin-bottom: 10px;'>";
  $historikkcount = mysqli_query($tilkobling, "SELECT count(*) FROM `historikk` WHERE `Brukernavn`='$Navn' ");
  while ($hisexist =$historikkcount->fetch_array()) {
    $count = $hisexist[0];
  }
  if ($count == 0) {
    echo "Ingen historikk å vise </div></div></div>";
  }
  else {
  $SQL2="SELECT * FROM `haldenvg_it`.`historikk` WHERE `Brukernavn`='$Navn' ORDER BY `Tid` DESC LIMIT 6";
  $resultat2=$tilkobling->query($SQL2) ;
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
            <div class='historikkcell'>
            $pb
            <div class='text'>
            <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 la til $Sum2,-</p>
            </div>
           </div>";
         }
         if ($Type==2){
              echo "
             <div class='historikkcell'>
           $pb
             <div class='text'>
             <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 la til dugnaden $element</p>
             </div>
            </div>";
         }
         if ($Type==3){
           echo "
          <div class='historikkcell'>
           $pb
          <div class='text'>
          <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 slettet dugnaden $element</p>
          </div>
         </div>";
         }
         if ($Type==4){
           echo "
         <div class='historikkcell'>
          $pb
         <div class='text'>
         <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 oppdaterte dugnaden $element</p>
         </div>
        </div>";
         }
         if ($Type==5){
           echo "
          <div class='historikkcell'>
          $pb
          <div class='text'>
          <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 la til $Sum2,- på dugnaden $element</p>
          </div>
         </div>";
         }
         if ($Type==6){
           echo "
          <div class='historikkcell'>
           $pb
          <div class='text'>
          <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 la til $element som sponsor ($Sum2,-) </p>
          </div>
         </div>";
         }
         if ($Type==7){
           echo "
          <div class='historikkcell'>
           $pb
          <div class='text'>
          <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 slettet sponsoren $element</p>
          </div>
         </div>";
         }
         if ($Type==8){
           echo "
          <div class='historikkcell'>
           $pb
          <div class='text'>
          <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 endret utgiften $element til $Sum2,-</p>
          </div>
         </div>";
       }
         if ($Type==9){
           echo "
          <div class='historikkcell'>
           $pb
          <div class='text'>
          <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 la til utgiften $element ($Sum2,-)</p>
          </div>
         </div>";
         }
         if ($Type==10){
           echo "
          <div class='historikkcell'>
          $pb
          <div class='text'>
          <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 slettet utgiften $element ($Sum2,-)</p>
          </div>
         </div>";
         }
         if ($Type==11){
           echo "
          <div class='historikkcell'>
          $pb
          <div class='text'>
          <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 oppdaterte sponsoren $element til $Sum2,- </p>
          </div>
         </div>";
         }
         if ($Type==12){
           echo "
          <div class='historikkcell'>
           $pb
          <div class='text'>
          <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 tjente $Sum2,- på dugnaden $element</p>
          </div>
         </div>";
         }
         if ($Type==13){
           echo "
          <div class='historikkcell'>
           $pb
          <div class='text'>
          <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 la til $element ($Sum2,-) i budsjettet</p>
          </div>
         </div>";
         }
         if ($Type==14){
           echo "
          <div class='historikkcell'>
           $pb
          <div class='text'>
          <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 oppdaterte budsjettet. Endret $element til $Sum2,-</p>
          </div>
         </div>";
         }
         if ($Type==15){
           echo "
          <div class='historikkcell'>
           $pb
          <div class='text'>
          <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p class='historikktext'>$navn2 slettet $element ($Sum2,-) fra budsjettet</p>
          </div>
         </div>";
         }
       }

  echo "</div></div></div>";
} ?>
   <?php
include 'footer.php';
        ?>
<script>
    var ingendugnad = function ingendugnad() {
    var Table = document.getElementsByClassName('dugnadtabell');
    var TableCount = Table.length;
    if (TableCount==0){
      document.getElementById('Tekst').innerHTML ='Ingen dugnader å vise';
    }
  }
  window.onload = ingendugnad();
    </script>
    <script>
    var drop = document.getElementById('profildropdown');
    var alt = document.getElementById('dropdownalt');
    var dug = document.getElementById('dugnader');
    var his = document.getElementById('historikk');
    var text = document.getElementById('Tekst');
    var dropcontent = document.getElementById('profildropdowncontent');
    function showalt() {
      dropcontent.style.display = 'block';
    }
    function hidealt() {
      dropcontent.style.display = 'none';
    }
    function hover() {
      dropcontent.style.color = "#a1a1a1";
    }
    function unhover() {
      dropcontent.style.color = "#ffffff";
    }
    function profildropdown() {
      if (alt.innerHTML == 'Historikk') {
        dug.style.display = 'none';
        his.style.display = 'flex';
        text.style.display = 'none';
        drop.innerHTML = 'Historikk <img id="arrow" src="Assets/dropdown.png" alt="Pil ned">';
        alt.innerHTML = 'Siste dugnader';
        dropcontent.style.display ='none';
        footer();
      }
      else if (alt.innerHTML == 'Siste dugnader') {
        dug.style.display = 'flex';
        his.style.display='none';
        text.style.display = 'block';
        alt.innerHTML = 'Historikk';
        drop.innerHTML = 'Siste dugnader <img id="arrow" src="Assets/dropdown.png" alt="Pil ned">';
        dropcontent.style.display ='none';
        footer();
      }
    }
    </script>
    <script>
    document.getElementsByClassName('profile')[0].setAttribute('src', 'Assets/a_profile.png');
    document.getElementsByClassName('profile')[0].id = 'active';
    document.getElementById('pro').className = 'box active dropdown';
    </script>
    <script src="Russebudsjett.js"></script>
</body>
</html>
