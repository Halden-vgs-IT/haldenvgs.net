<!DOCTYPE HTML>
<link rel="stylesheet" type="text/css" href="Russebudsjett.css">
<meta name="viewport" content="width=device-width">
<?php
ini_set('display_errors', '0');
session_start();
include 'connection.php';
$Brukernavn = $_SESSION['Brukernavn'];
?>
<html>
 <head>
   <meta charset="utf-8">
   <title>Russebudsjett - Inntekter og utgifter</title>
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
   <style>
   html {
     font-size: 16px;
   }
     .inntekttabell {
       margin-bottom: 10px;
    }
    tr {
      width: 100%;
    }
     .tabellcelle {
       width: 50%;
       vertical-align: middle;
    }
  #progressbar {
  width: 100%;
  float: left;
  display: flex;
  padding: 0% 2%;
  align-items: center;
  justify-content: space-between;
  height: 100px;
}
.bar {
  display: inline-block;
  color: #fd5157;
  justify-content: center;
  background-color: #474747;
  text-align: center;
  height: 10%;
  max-width: 100%;
}
.bar2 {
  display: inline-block;
  color: #fd5157;
  justify-content: center;
  background-color: #131313;
  text-align: center;
  height: 10%;
  max-width: 100%;
}
#border {
  width: 100%;
  background-color: #131313;
  border: inherit;
  display: inline-block;
}
#InntektModal {
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
footer {
  margin-top: 30px;
}
input[type=number] {
  width: 30%;
  min-width: 52px;
}
<?php
if (isset($_SESSION['Brukernavn'])) {
echo "
[id^=sopen]:hover, [id^=uopen]:hover {
  cursor: pointer;
}
";
}
?>
@media only screen and (max-width: 950px) and (min-width: 750px){
.box:hover active {
  color: #b9b9b9!important;
}
}
@media only screen and (min-width: 800px){
[class*="slett"] {
   visibility: hidden;
}
[class*="hoverbox"]:hover [class*="slett"] {
   visibility: visible;
}
}

  </style>

</head>
<body id="body" style="width: 100%;">
  <?php include 'header.php'; ?>
  <div id="content">
  <?php
  $hentinntekt=mysqli_query($tilkobling, "SELECT SUM(`Inntekt`) FROM `inntekt`;");
  while ($rad=$hentinntekt->fetch_array()){
  $totalpers=$rad[0];
  if ($totalpers == NULL) {
    $totalpers = 0;
  }
  }
  $hentsponsor=mysqli_query($tilkobling, "SELECT SUM(`Sum`) FROM `sponsor`;");
  while ($rad=$hentsponsor->fetch_array()){
  $totalspons=$rad[0];
  if ($totalspons == NULL) {
    $totalspons = 0;
  }
  }
  $hentutgifter=mysqli_query($tilkobling, "SELECT SUM(`Sum`) FROM `utgifter`;");
  while ($rad=$hentutgifter->fetch_array()){
  $totalutgift=$rad[0];
  if ($totalutgift == NULL) {
    $totalutgift = 0;
  }
  }
  $totalinntekt=$totalpers+$totalspons;
  $total=$totalinntekt+$totalutgift;
  $Pros=($totalinntekt/$total)*100;
  $Rest=100-$Pros;
   ?>
   <div class='col-12 label' style="text-align: center; font-size: 2rem; color: #fd5157;">
     <p style="margin: 0;">&#x25BC;</p>
   </div>
  <div class="row col-12" id="progressbar2">
      <div id="border2">
       <div class="bar" style="width:<?php echo $Pros;  ?>%; float: left;" >
     <p id='space1' style='display: none'>&nbsp;</p>
     <p id="inntekt1" >Inntekt: <?php echo $totalinntekt; echo ",-";?></p>
     </div>
     <div class="bar2" id="restbar2" style="width:<?php echo $Rest;?>%; float: left;">
       <p id='space2' style='display: none;'>&nbsp;</p>
      <p id="utgift1">Utgifter: <?php echo "$totalutgift,-"; ?></p>
    </div>
</div>
  </div>
  <div class="row col-12" id='labels' style='color: #fd5157;'>
    <p style='float: left;'>Inntekt: <?php echo $totalinntekt; echo ",-";?></p>
    <p style='float: right;'>Utgifter: <?php echo "$totalutgift,-"; ?></p>
  </div>


  <?php
  if ($Pros > 99) {
    echo "<script>document.getElementById('restbar').style.display = 'none'; </script>";
  }
  if ($Pros<19 || $Pros>81){
    echo "<script>
    document.getElementById('inntekt1').style.display = 'none';
    document.getElementById('utgift1').style.display = 'none';
    document.getElementById('labels').style.display = 'block';
    document.getElementById('space1').style.display = 'block';
    document.getElementById('space2').style.display = 'block';
   </script>";
  }
  else {
    echo "<script>
    function fjernlabels() {
    if (screen.width>700){
    document.getElementById('inntekt1').style.display = 'block';
    document.getElementById('utgift1').style.display = 'block';
    document.getElementById('labels').style.display = 'none';
    document.getElementById('space1').style.display = 'none';
    document.getElementById('space2').style.display = 'none';
  }
  else {
    document.getElementById('inntekt1').style.display = 'none';
    document.getElementById('utgift1').style.display = 'none';
    document.getElementById('labels').style.display = 'block';
    document.getElementById('space1').style.display = 'block';
    document.getElementById('space2').style.display = 'block';
  }}
  window.onload = fjernlabels();
    </script>";
  }
  ?>
  <div class="row" id="inntekt">
    <div class='col-6 col-m-12'>
      <h2>Inntekter</h2>
  <br>
  <h3>Personer</h3><br>
  <?php
  $sjekkpersoner = mysqli_query($tilkobling, "SELECT count(*) FROM `logginn`");
    while ($rad=$sjekkpersoner->fetch_array()){
       $antallp=$rad[0];
    }
      if ($antallp>0){
  $SQL="SELECT * FROM `haldenvg_it`.inntekt;";  //HENT INNTEKTSTABELL
  $resultat=$tilkobling->query($SQL) ;
    echo "<table class='inntekttabell col-12 col-m-12'>" ;
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
    if (isset($_SESSION["Brukernavn"])){
    echo "<button style='float: right;' href=''class='button'  id='Inntektbtn'>Legg til egenandel</button><br>";
  }
    $SQL2=mysqli_query($tilkobling,"SELECT SUM(Inntekt) AS 'value_sum' FROM `haldenvg_it`.`inntekt`");
    while ($rad=$SQL2->fetch_assoc()){
      $inntektpers = $rad['value_sum'];
      echo "<p>Totalt: ";
      echo $inntektpers;
      echo ",-</p>";
    }
  echo "<br><br>";
}
else {
  echo "<p>Ingen eksisterende brukere </p>";
}
  ?>
  <?php
    if (isset($_SESSION['Brukernavn'])) {
      echo "
      <div id='InntektModal' class='modal'>
        <div class='modal-content'>
          <span class='close' onclick='closemodal1()'>&times;</span>
          <div class='modalform'>
    <form action='Actionfiler/Inntektogutgifter/Personliginntekt.php' method='post' class='col-12'>
    <h2>Legg til egenandel</h2>
      <table>
        <tr>
          <td style='width: 30%;'>Sum: </td>
          <td style='width: 40%;'><input type='number' name='Sum' required=''></td>
          <td style='width: 30%; text-align: center;'><input class='button' type='submit' value='Legg til'>
        </tr>
     </table><br>
  </form>
  </div>
  </div>
  </div>
  <br>";
  echo "<script>
  var inntektmodal = document.getElementById('InntektModal');
  var inntektbtn= document.getElementById('Inntektbtn')
  var span = document.getElementsByClassName('close')[1];
  inntektbtn.onclick =function() {
    inntektmodal.style.display = 'block';
  }
  function closemodal1() {
  inntektmodal.style.display = 'none';
  }
  inntektmodal.onclick = function(ev) {
        if(ev.target.className !== 'modal-content' && ev.target.className == 'modal' ){
           inntektmodal.style.display = 'none';
        }
  }
  </script>";
}
?>
  <h3>Sponsorer</h3><br>
<?php
$sjekkspons = mysqli_query($tilkobling, "SELECT count(*) FROM `sponsor`");
  while ($rad=$sjekkspons->fetch_array()){
     $antalls=$rad[0];
  }
    if ($antalls>0){
 $SQL="SELECT * FROM `haldenvg_it`.sponsor";  //HENT sponsortabell
 $resultat=$tilkobling->query($SQL) ;
    echo "<table class='inntekttabell col-12 col-m-12'>" ;
    echo "<tr>" ;
    echo "<th class='tabellcelle'>Sponsor</th>" ;
    echo  "<th class='tabellcelle'>Sum</th>" ;
    echo "</tr>" ;

      while ($rad=$resultat->fetch_assoc()) {
        $Sponsor =$rad["Sponsor"] ;
        $Sum=$rad["Sum"] ;
        $Id=$rad["Id"];
        echo "<tr id='srow1-$Id'>" ;
        echo "<td class='tabellcelle shoverbox$Id'>";
        if (isset($_SESSION['Brukernavn'])) {
          echo"
          <div class='pbhover' style='float:left;'>
         <span class='navn' id='popup$Id'>Slett</span>
         <form  action='Actionfiler/Inntektogutgifter/Slettsponsor.php' method='post' class='sslett$Id'>
         <input type='hidden' name='Item' value='$Sponsor'>
         <input type='hidden' name='Sum' value='$Sum'>
         <input type='hidden' name='Id' value='$Id'>
         <input type='submit' value='&times;' class='deleteupdatebutton' style='font-size: 1.25rem'>
         </form></div>";
       }
        echo "$Sponsor</td>" ;
        echo "<td id='sopen$Id' class='tabellcelle'>$Sum,-</td>" ;
        echo "</tr>" ;
       if (isset($_SESSION['Brukernavn'])) {
        echo "<tr id='srow2-$Id' style='display: none'>" ;
        echo "<td class='tabellcelle shoverbox$Id'>
        <div class='pbhover' style='float:left;'>
       <span class='navn' id='popup$Id'>Slett</span>
       <form  action='Actionfiler/Inntektogutgifter/Slettsponsor.php' method='post' class='sslett$Id'>
       <input type='hidden' name='Item' value='$Sponsor'>
       <input type='hidden' name='Sum' value='$Sum'>
       <input type='hidden' name='Id' value='$Id'>
       <input type='submit' value='&times;' class='deleteupdatebutton' style='font-size: 1.25rem'>
       </form></div>
        $Sponsor</td>" ;
        echo "<td class='tabellcelle'  id=''>
        <span style='float: right; font-size: 1.25rem' class='deleteupdatebutton'   id='sclose$Id'>&times;</span>
        <form action='Actionfiler/Inntektogutgifter/Oppdatersponsor.php' method='post' >
        <input type='number' value='$Sum' name='Sum'>
        <input type='hidden' value='$Id' name='Id'>
        <input type='hidden' value='$Sponsor' name='Item'>
        <input type='submit' value='Oppdater' class='button'>
        </form>
        </td></tr>
        <script>
        var open = document.getElementById('sopen$Id');
        var close = document.getElementById('sclose$Id');
        var srowa$Id= document.getElementById('srow1-$Id');
        var srowb$Id = document.getElementById('srow2-$Id');

          open.onclick = function() {
          srowa$Id.style.display = 'none';
          srowb$Id.style.display= 'table-row';
        }
        close.onclick = function(){
          srowa$Id.style.display = 'table-row';
          srowb$Id.style.display= 'none';
        }

        </script>";
      }}
    echo "</table>" ;
  }
  else {
    echo "<p>Ingen sponsorer lagt til</p>";
  }
    if (isset($_SESSION["Brukernavn"])){
      echo "<button style='float: right;' href=''class='button'  id='Sponsorbtn'>Legg til sponsor</button><br>";
    }
        if ($antalls>0){
    $SQL2=mysqli_query($tilkobling,"SELECT SUM(`Sum`) AS 'value_sum' FROM `haldenvg_it`.`sponsor`");
    while ($rad=$SQL2->fetch_assoc()){
      $inntektspons=$rad['value_sum'];
      echo "<p>Totalt: ";
      echo $inntektspons;
      echo ",-</p>";
    }
    }
      echo "<br>";
      if (isset($_SESSION['Brukernavn'])) {
        echo "
        <div id='SponsorModal' class='modal'>
          <div class='modal-content'>
            <span class='close' onclick='closemodal2()'>&times;</span>
            <div class='modalform'>
            <form action='Actionfiler/Inntektogutgifter/Leggtilsponsor.php' method='post' formtarget='Innhold' class='col-12'>
            <h2>Legg til sponsor</h2>
            <table>
              <tr>
                <td>Sponsor:</td>
                <td><input type='text' name='Sponsor' required=''></td>
              </tr>
             <tr>
               <td>Sum:</td>
               <td><input type='number' name='Sum' required=''><br></td>
             </tr>
            <tr class='btncell'><td  class='btncell'><br><input class='button' type='submit' value='Legg til'></td></tr>
           </table>
    </form>
    </div>
    </div>
    </div>";
    echo "<script>
    var sponsmodal = document.getElementById('SponsorModal');
    var sponsbtn= document.getElementById('Sponsorbtn')
    var span = document.getElementsByClassName('close')[2];
    sponsbtn.onclick =function() {
      sponsmodal.style.display = 'block';
    }
    function closemodal2() {
    sponsmodal.style.display = 'none';
    }
    sponsmodal.onclick = function(ev) {
          if(ev.target.className !== 'modal-content' && ev.target.className == 'modal' ){
             sponsmodal.style.display = 'none';
          }
    }
    </script>";
  }

?>
  <h3><?php
   if ($antalls!=0 || $antallp!=0) {
  $totalinntekt=$inntektpers+$inntektspons; echo "$totalinntekt,-";
}?></h3><br>
</div>
<div class='col-6 col-m-12'>
  <h2>Utgifter</h2>
  <br>
  <h3 style='margin: 0; display: block;' id='linebreak'> &nbsp;</h3>
  <script> if (screen.width<700){
    document.getElementById("linebreak").style.display = 'none';
  }</script>
<?php
$sjekkutgifter = mysqli_query($tilkobling, "SELECT count(*) FROM `utgifter`");
  while ($rad=$sjekkutgifter->fetch_array()){
     $antall=$rad[0];
  }
    if ($antall>0){
    echo "<table class='inntekttabell col-12'>" ;
$SQL="SELECT * FROM `haldenvg_it`.`utgifter` WHERE `Kategori`='Bil m/ utstyr'";  //HENT INNTEKTSTABELL
     $resultat=$tilkobling->query($SQL) ;
     $sjekkutgift = mysqli_query($tilkobling, "SELECT count(*) FROM `utgifter` WHERE `Kategori`='Bil m/ utstyr'");
       while ($rad=$sjekkutgift->fetch_array()){
         $antall=$rad[0];
       }
       if ($antall>0){
    echo "<tr>" ;
    echo "<th class='tabellcelle' colspan='2' style='text-align: left;'>Bil m/utstyr</th>" ;
    echo "</tr>" ;

      while ($rad=$resultat->fetch_assoc()) {
        $Utgift  =$rad["Utgift"] ;
        $Sum=$rad["Sum"] ;
        $Id=$rad["Id"];
        echo "<tr id='urow1-$Id'>" ;
        echo "<td class='tabellcelle uhoverbox$Id'>";
        if (isset($_SESSION['Brukernavn'])) {
          echo"
          <div class='pbhover' style='float:left;'>
         <span class='navn' id='popup$Id'>Slett</span>
         <form  action='Actionfiler/Inntektogutgifter/Slettutgift.php' method='post' class='uslett$Id'>
         <input type='hidden' name='Item' value='$Utgift'>
         <input type='hidden' name='Sum' value='$Sum'>
         <input type='hidden' name='Id' value='$Id'>
         <input type='submit' value='&times;' class='deleteupdatebutton' style='font-size: 1.25rem' >
         </form></div>"; }
        echo "$Utgift</td>" ;
        echo "<td id='uopen$Id' class='tabellcelle'>$Sum,-</td>" ;
        echo "</tr>" ;
       if (isset($_SESSION['Brukernavn'])) {
        echo "<tr id='urow2-$Id' style='display: none'>" ;
        echo "<td class='tabellcelle uhoverbox$Id'>
        <div class='pbhover' style='float:left;'>
       <span class='navn' id='popup$Id'>Slett</span>
       <form  action='Actionfiler/Inntektogutgifter/Slettutgift.php' method='post' class='uslett$Id'>
       <input type='hidden' name='Item' value='$Utgift'>
       <input type='hidden' name='Sum' value='$Sum'>
       <input type='hidden' name='Id' value='$Id'>
       <input type='submit' value='&times;' class='deleteupdatebutton' style='font-size: 1.25rem'>
       </form></div>
        $Utgift</td>" ;
        echo "<td class='tabellcelle'  id=''>
        <span style='float: right; font-size: 1.25rem' class='deleteupdatebutton' id='uclose$Id'>&times;</span>
        <form action='Actionfiler/Inntektogutgifter/Oppdaterutgift.php' method='post' id=''>
        <input type='number' value='$Sum' name='Sum'>
        <input type='hidden' value='$Id' name='Id'>
        <input type='hidden' value='$Utgift' name='Item'>
        <input type='submit' value='Oppdater' class='button'>
        </form>
        </td></tr>
        <script>
        var open = document.getElementById('uopen$Id');
        var close = document.getElementById('uclose$Id');
        var urowa$Id= document.getElementById('urow1-$Id');
        var urowb$Id = document.getElementById('urow2-$Id');

          open.onclick = function() {
          urowa$Id.style.display = 'none';
          urowb$Id.style.display= 'table-row';
        }
        close.onclick = function(){
          urowa$Id.style.display = 'table-row';
          urowb$Id.style.display= 'none';
        }
        </script>";
      }}
      }
    echo "<br>" ;
        $sjekkutgift = mysqli_query($tilkobling, "SELECT count(*) FROM `utgifter` WHERE `Kategori`='Russetreff'");
          while ($rad=$sjekkutgift->fetch_array()){
            $antall=$rad[0];
          }
          if ($antall>0) {
            $SQL="SELECT * FROM `haldenvg_it`.`utgifter` WHERE `Kategori`='Russetreff'";
            $resultat=$tilkobling->query($SQL) ;
       echo "<tr>" ;
       echo "<th class='tabellcelle'  colspan='2' style='text-align: left;'>Russtreff</th>" ;
       echo "</tr>" ;

       while ($rad=$resultat->fetch_assoc()) {
         $Utgift  =$rad["Utgift"] ;
         $Sum=$rad["Sum"] ;
         $Id=$rad["Id"];
         echo "<tr id='urow1-$Id'>" ;
         echo "<td class='tabellcelle uhoverbox$Id'>";
         if (isset($_SESSION['Brukernavn'])) {
           echo"
           <div class='pbhover' style='float:left;'>
          <span class='navn' id='popup$Id'>Slett</span>
          <form  action='Actionfiler/Inntektogutgifter/Slettutgift.php' method='post' class='uslett$Id'>
          <input type='hidden' name='Item' value='$Utgift'>
          <input type='hidden' name='Sum' value='$Sum'>
          <input type='hidden' name='Id' value='$Id'>
          <input type='submit' value='&times;' class='deleteupdatebutton' style='font-size: 1.25rem'>
          </form></div>"; }
         echo "$Utgift</td>" ;
         echo "<td id='uopen$Id' class='tabellcelle'>$Sum,-</td>" ;
         echo "</tr>" ;
        if (isset($_SESSION['Brukernavn'])) {
         echo "<tr id='urow2-$Id' style='display: none'>" ;
         echo "<td class='tabellcelle uhoverbox$Id'>
         <div class='pbhover' style='float:left;'>
        <span class='navn' id='popup$Id'>Slett</span>
        <form  action='Actionfiler/Inntektogutgifter/Slettutgift.php' method='post' class='uslett$Id'>
        <input type='hidden' name='Item' value='$Utgift'>
        <input type='hidden' name='Sum' value='$Sum'>
        <input type='hidden' name='Id' value='$Id'>
        <input type='submit' value='&times;' class='deleteupdatebutton' style='font-size: 1.25rem'>
        </form></div>
         $Utgift</td>" ;
         echo "<td class='tabellcelle'  id=''>
         <span style='float: right; font-size: 1.25rem;' class='deleteupdatebutton' id='uclose$Id'>&times;</span>
         <form action='Actionfiler/Inntektogutgifter/Oppdaterutgift.php' method='post' id=''>
         <input type='number' value='$Sum' name='Sum'>
         <input type='hidden' value='$Id' name='Id'>
         <input type='hidden' value='$Utgift' name='Item'>
         <input type='submit' value='Oppdater' class='button'>
         </form>
         </td></tr>
         <script>
         var open = document.getElementById('uopen$Id');
         var close = document.getElementById('uclose$Id');
         var rowa$Id= document.getElementById('urow1-$Id');
         var rowb$Id = document.getElementById('urow2-$Id');

           open.onclick = function() {
           rowa$Id.style.display = 'none';
           rowb$Id.style.display= 'table-row';
         }
         close.onclick = function(){
           rowa$Id.style.display = 'table-row';
           rowb$Id.style.display= 'none';
         }
         </script>";
       }}
       }
       $SQL="SELECT * FROM `haldenvg_it`.`utgifter` WHERE `Kategori`='Klær'";  //HENT INNTEKTSTABELL
           $resultat=$tilkobling->query($SQL) ;
           $sjekkutgift = mysqli_query($tilkobling, "SELECT count(*) FROM `utgifter` WHERE `Kategori`='Klær'");
             while ($rad=$sjekkutgift->fetch_array()){
               $antall=$rad[0];
             }
             if ($antall>0) {
          echo "<tr>" ;
          echo "<th class='tabellcelle'  colspan='2' style='text-align: left;'>Klær</th>" ;
          echo "</tr>" ;

              while ($rad=$resultat->fetch_assoc()) {
                $Utgift  =$rad["Utgift"] ;
                $Sum=$rad["Sum"] ;
                $Id=$rad["Id"];
                echo "<tr id='urow1-$Id'>" ;
                echo "<td class='tabellcelle uhoverbox$Id'>";
                if (isset($_SESSION['Brukernavn'])) {
                  echo"
                  <div class='pbhover' style='float:left;'>
                 <span class='navn' id='popup$Id'>Slett</span>
                 <form  action='Actionfiler/Inntektogutgifter/Slettutgift.php' method='post' class='uslett$Id'>
                 <input type='hidden' name='Item' value='$Utgift'>
                 <input type='hidden' name='Sum' value='$Sum'>
                 <input type='hidden' name='Id' value='$Id'>
                 <input type='submit' value='&times;' class='deleteupdatebutton' style='font-size: 1.25rem'>
                 </form></div>"; }
                echo "$Utgift</td>" ;
                echo "<td id='uopen$Id' class='tabellcelle'>$Sum,-</td>" ;
                echo "</tr>" ;
               if (isset($_SESSION['Brukernavn'])) {
                echo "<tr id='urow2-$Id' style='display: none'>" ;
                echo "<td class='tabellcelle uhoverbox$Id'>
                <div class='pbhover' style='float:left;'>
               <span class='navn' id='popup$Id'>Slett</span>
               <form  action='Actionfiler/Inntektogutgifter/Slettutgift.php' method='post' class='uslett$Id'>
               <input type='hidden' name='Item' value='$Utgift'>
               <input type='hidden' name='Sum' value='$Sum'>
               <input type='hidden' name='Id' value='$Id'>
               <input type='submit' value='&times;' class='deleteupdatebutton' style='font-size: 1.25rem'>
               </form></div>
                $Utgift</td>" ;
                echo "<td class='tabellcelle'  id=''>
                <span style='float: right; font-size: 1.25rem;' class='deleteupdatebutton'  id='uclose$Id'>&times;</span>
                <form action='Actionfiler/Inntektogutgifter/Oppdaterutgift.php' method='post' id=''>
                <input type='number' value='$Sum' name='Sum'>
                <input type='hidden' value='$Id' name='Id'>
                <input type='hidden' value='$Utgift' name='Item'>
                <input type='submit' value='Oppdater' class='button'>
                </form>
                </td></tr>
                <script>
                var open = document.getElementById('uopen$Id');
                var close = document.getElementById('uclose$Id');
                var rowa$Id= document.getElementById('urow1-$Id');
                var rowb$Id = document.getElementById('urow2-$Id');

                  open.onclick = function() {
                  rowa$Id.style.display = 'none';
                  rowb$Id.style.display= 'table-row';
                }
                close.onclick = function(){
                  rowa$Id.style.display = 'table-row';
                  rowb$Id.style.display= 'none';
                }
                </script>";
              }}
              }
          $SQL="SELECT * FROM `haldenvg_it`.`utgifter` WHERE `Kategori`='Annet'";  //HENT INNTEKTSTABELL
              $resultat=$tilkobling->query($SQL) ;
              $sjekkutgift = mysqli_query($tilkobling, "SELECT count(*) FROM `utgifter` WHERE `Kategori`='Annet'");
                while ($rad=$sjekkutgift->fetch_array()){
                  $antall=$rad[0];
                }
                if ($antall>0) {
             echo "<tr>" ;
             echo "<th class='tabellcelle'  colspan='2' style='text-align: left;'>Diverse</th>" ;
             echo "</tr>" ;

                 while ($rad=$resultat->fetch_assoc()) {
                   $Utgift  =$rad["Utgift"] ;
                   $Sum=$rad["Sum"] ;
                   $Id=$rad["Id"];
                   echo "<tr id='urow1-$Id'>" ;
                   echo "<td class='tabellcelle uhoverbox$Id'>";
                   if (isset($_SESSION['Brukernavn'])) {
                     echo"
                     <div class='pbhover' style='float:left;'>
                    <span class='navn' id='popup$Id'>Slett</span>
                    <form  action='Actionfiler/Inntektogutgifter/Slettutgift.php' method='post' class='uslett$Id'>
                    <input type='hidden' name='Item' value='$Utgift'>
                    <input type='hidden' name='Sum' value='$Sum'>
                    <input type='hidden' name='Id' value='$Id'>
                    <input type='submit' value='&times;' class='deleteupdatebutton' style='font-size: 1.25rem'>
                    </form></div>"; }
                   echo "$Utgift</td>" ;
                   echo "<td id='uopen$Id' class='tabellcelle'>$Sum,-</td>" ;
                   echo "</tr>" ;
                  if (isset($_SESSION['Brukernavn'])) {
                   echo "<tr id='urow2-$Id' style='display: none'>" ;
                   echo "<td class='tabellcelle uhoverbox$Id'>
                   <div class='pbhover' style='float:left;'>
                  <span class='navn' id='popup$Id'>Slett</span>
                  <form  action='Actionfiler/Inntektogutgifter/Slettutgift.php' method='post' class='uslett$Id'>
                  <input type='hidden' name='Item' value='$Utgift'>
                  <input type='hidden' name='Sum' value='$Sum'>
                  <input type='hidden' name='Id' value='$Id'>
                  <input type='submit' value='&times;' class='deleteupdatebutton' style='font-size: 1.25rem'>
                  </form></div>
                   $Utgift</td>" ;
                   echo "<td class='tabellcelle'  id=''>
                   <span style='float: right; font-size: 1.25rem;' class='deleteupdatebutton'  id='uclose$Id'>&times;</span>
                   <form action='Actionfiler/Inntektogutgifter/Oppdaterutgift.php' method='post' id=''>
                   <input type='number' value='$Sum' name='Sum'>
                   <input type='hidden' value='$Id' name='Id'>
                   <input type='hidden' value='$Utgift' name='Item'>
                   <input type='submit' value='Oppdater' class='button'>
                   </form>
                   </td></tr>
                   <script>
                   var open = document.getElementById('uopen$Id');
                   var close = document.getElementById('uclose$Id');
                   var rowa$Id= document.getElementById('urow1-$Id');
                   var rowb$Id = document.getElementById('urow2-$Id');

                     open.onclick = function() {
                     rowa$Id.style.display = 'none';
                     rowb$Id.style.display= 'table-row';
                   }
                   close.onclick = function(){
                     rowa$Id.style.display = 'table-row';
                     rowb$Id.style.display= 'none';
                   }
                   </script>";
                 }}
            }
             echo "</table>" ;
           }
           else {
             echo "<p>Ingen utgifter lagt til</p></div>";
           }
       if (isset($_SESSION["Brukernavn"])){
      echo "<button style='float: right;' href=''class='button'  id='Utgiftbtn'>Legg til utgift</button>";
    }
    $sjekkutgifter = mysqli_query($tilkobling, "SELECT count(*) FROM `utgifter`");
      while ($rad=$sjekkutgifter->fetch_array()){
         $antallu=$rad[0];
      }
        if ($antallu>0){
    $SQL2=mysqli_query($tilkobling,"SELECT SUM(`Sum`) AS 'value_sum' FROM `haldenvg_it`.`utgifter`");
    while ($rad=$SQL2->fetch_assoc()){
      echo "<h3>";
      echo $rad['value_sum'];
      echo ",-</h3></div>";
    }
  }
    if (isset($_SESSION['Brukernavn'])) {
      echo "
      <div id='UtgiftModal' class='modal'>
        <div class='modal-content'>
          <span class='close' onclick='closemodal3()'>&times;</span>
          <div class='modalform'>
          <form id='utgift' action='Actionfiler/Inntektogutgifter/Leggtilutgift.php' method='post' formtarget='Innhold' class='col-12'>
          <h2>Legg til utgift</h2>
          <table>
            <tr>
              <td>Utgift:</td>
              <td><input type='text' name='Utgift' required=''></td>
            </tr>
            <tr>
              <td>Kategori:</td>
              <td>
              <select form='utgift' name='Kategori'>;
                 <option value='Bil m/ utstyr'>Bil m/ utstyr</option>
                 <option value='Russetreff'>Russetreff</option>
                 <option value='Klær'>Klær</option>
                 <option value='Annet'>Annet</option>
              </select>
            </td>
            </tr>
           <tr>
             <td>Sum:</td>
             <td><input type='number' name='Sum' required=''><br></td>
           </tr>
          <tr class='btncell'><td  class='btncell'><br><input class='button' type='submit' value='Legg til'></td></tr>
          </table>
  </form>
  </div>
  </div>
  </div>
  <br>";
  echo "<script>
  var utgiftmodal = document.getElementById('UtgiftModal');
  var utgiftbtn= document.getElementById('Utgiftbtn')
  var span = document.getElementsByClassName('close')[3];
  utgiftbtn.onclick =function() {
    utgiftmodal.style.display = 'block';
  }
  function closemodal3() {
  utgiftmodal.style.display = 'none';
  }
  utgiftmodal.onclick = function(ev) {
        if(ev.target.className !== 'modal-content' && ev.target.className == 'modal' ){
           utgiftmodal.style.display = 'none';
        }
  }
  </script>";
}
?>
</div>
<?php
include 'footer.php'; ?>
<script>
document.getElementsByClassName('money')[0].setAttribute('src', 'Assets/a_money.png');
document.getElementsByClassName('money')[0].id = 'active';
document.getElementById('inn').className = 'box active';
</script>
<script src="Russebudsjett.js"></script>

</html>
