<!DOCTYPE HTML>
<?php
session_start();
ini_set('display_errors','0');
$Brukernavn=$_SESSION["Brukernavn"];
?>
<html>
 <head>
   <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="Russebudsjett.css">

   <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
  <meta name="viewport" content="width=device-width">
   <title>Russebudsjett - Budsjett</title>
   <style>
     .inntekttabell {
       border: 1px solid black;
       border-collapse: collapse;
       text-align: center;
    }
     .tabellcelle {
       border: 1px solid black;
       border-collapse: collapse;
       padding: 5px 10px;
       width: 400px;
       text-align: center;
    }
    .deleteupdatebutton {
      font-size: 1.2rem;
    }
    #budsjettbuttons {
      margin-top: 20px;
    }
    .pbhover .navn {
      bottom: 100%;
      margin-left: -26px;
    }
    input[type='number'] {
      width: 50%;
    }
    <?php
    if (isset($_SESSION['Brukernavn'])) {
    echo "
    [id^=open]:hover {
      cursor: pointer;
    }
    ";
  }
    ?>
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
<body class='body' >
<?php include 'header.php'; ?>
  <div id="content">
<?php
include 'connection.php';

echo "<div class='col-12' style='display: flex; justify-content: center;'>";
echo "<div class='col-6 col-t-10 col-m-12'>";
echo "<h1>Budsjett</h1>";
$sjekkhistorikk = mysqli_query($tilkobling, "SELECT count(*) FROM `historikk` WHERE `Type`='13' OR `Type`='14' OR `Type`='15'");
  while ($rad=$sjekkhistorikk->fetch_array()){
     $antall=$rad[0];
  }
    if ($antall>0){
$sistedato=mysqli_query($tilkobling, "SELECT MAX(`Tid`) FROM `historikk` WHERE `Type`='13' OR `Type`='14' OR `Type`='15';");
while ($rad=$sistedato->fetch_array()){
  $oppdatert=date("d/m/Y H:i", strtotime($rad[0]));
  echo "<p>Sist oppdatert: $oppdatert</p><br>";
}}
$sjekkantall = mysqli_query($tilkobling, "SELECT count(*) FROM `budsjett`");
  while ($rad=$sjekkantall->fetch_array()){
     $antall=$rad[0];
  }
    if ($antall>0){
echo "<table class='inntekttabell col-12'>" ;
  $SQL="SELECT * FROM `haldenvg_it`.`budsjett` WHERE `Kategori`='Bil m/ utstyr'";  //HENT INNTEKTSTABELL
       $resultat=$tilkobling->query($SQL) ;
       $sjekkbudsjett = mysqli_query($tilkobling, "SELECT count(*) FROM `budsjett` WHERE `Kategori`='Bil m/ utstyr'");
         while ($rad=$sjekkbudsjett->fetch_array()){
           $antall=$rad[0];
         }
         if ($antall>0){
      echo "<tr>" ;
      echo "<th class='tabellcelle' colspan='2' style='text-align: left;'>Bil m/utstyr</th>" ;
      echo "</tr>" ;

        while ($rad=$resultat->fetch_assoc()) {
          $Item  =$rad["item"] ;
          $Sum=$rad["sum"] ;
          $Id=$rad["id"];
             echo "<tr id='row1-$Id'>" ;
             echo "<td class='tabellcelle hoverbox$Id'>";
             if (isset($_SESSION['Brukernavn'])) {
               echo"
               <div class='pbhover' style='float:left;'>
              <span class='navn' id='popup$Id'>Slett</span>
              <form  action='Actionfiler/Budsjett/Slettbudsjett.php' method='post' class='slett$Id'>
              <input type='hidden' name='Item' value='$Item'>
              <input type='hidden' name='Sum' value='$Sum'>
              <input type='hidden' name='Id' value='$Id'>
              <input type='submit' value='&times;' class='deleteupdatebutton'>
              </form></div>"; }
             echo "$Item</td>" ;
             echo "<td id='open$Id' class='tabellcelle'>$Sum,-</td>" ;
             echo "</tr>" ;
            if (isset($_SESSION['Brukernavn'])) {
             echo "<tr id='row2-$Id' style='display: none'>" ;
             echo "<td class='tabellcelle hoverbox$Id'>
             <div class='pbhover' style='float:left;'>
            <span class='navn' id='popup$Id'>Slett</span>
            <form  action='Actionfiler/Budsjett/Slettbudsjett.php' method='post' class='slett$Id'>
            <input type='hidden' name='Item' value='$Item'>
            <input type='hidden' name='Sum' value='$Sum'>
            <input type='hidden' name='Id' value='$Id'>
            <input type='submit' value='&times;' class='deleteupdatebutton'>
            </form></div>
             $Item</td>" ;
             echo "<td class='tabellcelle'  id=''>
             <span style='float: right' class='deleteupdatebutton' id='close$Id'>&times;</span>
             <form action='Actionfiler/Budsjett/Oppdaterbudsjett.php' method='post' id=''>
             <input type='number' value='$Sum' name='Sum'>
             <input type='hidden' value='$Id' name='Id'>
             <input type='hidden' value='$Item' name='Item'>
             <input type='submit' value='Oppdater' class='button'>
             </form>
             </td></tr>
             <script>
             var open = document.getElementById('open$Id');
             var close = document.getElementById('close$Id');
             var content = document.getElementById('content');
             var rowa$Id= document.getElementById('row1-$Id');
             var rowb$Id = document.getElementById('row2-$Id');

               open.onclick = function() {
               rowa$Id.style.display = 'none';
               rowb$Id.style.display= 'table-row';
             }
             close.onclick = function(){
               rowa$Id.style.display = 'table-row';
               rowb$Id.style.display= 'none';
             }
             </script>";
           }}}

          $sjekkbudsjett = mysqli_query($tilkobling, "SELECT count(*) FROM `budsjett` WHERE `Kategori`='Russetreff'");
            while ($rad=$sjekkbudsjett->fetch_array()){
              $antall=$rad[0];
            }
            if ($antall>0) {
              $SQL="SELECT * FROM `haldenvg_it`.`budsjett` WHERE `Kategori`='Russetreff'";
              $resultat=$tilkobling->query($SQL) ;
         echo "<tr>" ;
         echo "<th class='tabellcelle'  colspan='2' style='text-align: left;'>Russetreff</th>" ;
         echo "</tr>" ;

         while ($rad=$resultat->fetch_assoc()) {
           $Item  =$rad["item"] ;
           $Sum=$rad["sum"] ;
           $Id=$rad["id"];
              echo "<tr id='row1-$Id'>" ;
              echo "<td class='tabellcelle hoverbox$Id'>";
              if (isset($_SESSION['Brukernavn'])) {
                echo"
                <div class='pbhover' style='float:left;'>
               <span class='navn' id='popup$Id'>Slett</span>
               <form  action='Actionfiler/Budsjett/Slettbudsjett.php' method='post' class='slett$Id'>
               <input type='hidden' name='Item' value='$Item'>
               <input type='hidden' name='Sum' value='$Sum'>
               <input type='hidden' name='Id' value='$Id'>
               <input type='submit' value='&times;' class='deleteupdatebutton'>
               </form></div>"; }
              echo "$Item</td>" ;
              echo "<td id='open$Id' class='tabellcelle'>$Sum,-</td>" ;
              echo "</tr>" ;
              if (isset($_SESSION['Brukernavn'])){
              echo "<tr id='row2-$Id' style='display: none'>" ;
              echo "<td class='tabellcelle hoverbox$Id'>
              <div class='pbhover' style='float:left;'>
             <span class='navn' id='popup$Id'>Slett</span>
             <form  action='Actionfiler/Budsjett/Slettbudsjett.php' method='post' class='slett$Id'>
             <input type='hidden' name='Item' value='$Item'>
             <input type='hidden' name='Sum' value='$Sum'>
             <input type='hidden' name='Id' value='$Id'>
             <input type='submit' value='&times;' class='deleteupdatebutton'>
             </form></div>$Item</td>" ;
              echo "<td class='tabellcelle'  id=''>
              <span style='float: right' class='deleteupdatebutton' id='close$Id'>&times;</span>
              <form action='Actionfiler/Budsjett/Oppdaterbudsjett.php' method='post'>
              <input type='number' value='$Sum' name='Sum'>
              <input type='hidden' value='$Id' name='Id'>
              <input type='hidden' value='$Item' name='Item'>
              <input type='submit' value='Oppdater' class='button'>
              </form>
              </td></tr>
              <script>
              var open = document.getElementById('open$Id');
              var close = document.getElementById('close$Id');
              var rowa$Id= document.getElementById('row1-$Id');
              var rowb$Id = document.getElementById('row2-$Id');

              open.onclick = function(){
                rowa$Id.style.display = 'none';
                rowb$Id.style.display= 'table-row';
              }
              close.onclick = function(){
                rowa$Id.style.display = 'table-row';
                rowb$Id.style.display= 'none';
              }
              </script>";
            }}}

         $SQL="SELECT * FROM `haldenvg_it`.`budsjett` WHERE `Kategori`='Klær'";  //HENT INNTEKTSTABELL
             $resultat=$tilkobling->query($SQL) ;
             $sjekkbudsjett = mysqli_query($tilkobling, "SELECT count(*) FROM `budsjett` WHERE `Kategori`='Klær'");
               while ($rad=$sjekkbudsjett->fetch_array()){
                 $antall=$rad[0];
               }
               if ($antall>0) {
            echo "<tr>" ;
            echo "<th class='tabellcelle'  colspan='2' style='text-align: left;'>Klær</th>" ;
            echo "</tr>" ;

            while ($rad=$resultat->fetch_assoc()) {
              $Item  =$rad["item"] ;
              $Sum=$rad["sum"] ;
              $Id=$rad["id"];
                 echo "<tr id='row1-$Id'>" ;
                 echo "<td class='tabellcelle hoverbox$Id'>";
                 if (isset($_SESSION['Brukernavn'])) {
                   echo"
                   <div class='pbhover' style='float:left;'>
                  <span class='navn' id='popup$Id'>Slett</span>
                  <form  action='Actionfiler/Budsjett/Slettbudsjett.php' method='post' class='slett$Id'>
                  <input type='hidden' name='Item' value='$Item'>
                  <input type='hidden' name='Sum' value='$Sum'>
                  <input type='hidden' name='Id' value='$Id'>
                  <input type='submit' value='&times;' class='deleteupdatebutton'>
                  </form></div>"; }
                 echo "$Item</td>" ;
                 echo "<td id='open$Id' class='tabellcelle hoverbox$Id'>$Sum,-</td>" ;
                 echo "</tr>" ;
                 if (isset($_SESSION['Brukernavn'])){
                 echo "<tr id='row2-$Id' style='display: none'>" ;
                 echo "<td class='tabellcelle'>
                 <div class='pbhover' style='float:left;'>
                <span class='navn' id='popup$Id'>Slett</span>
                <form  action='Actionfiler/Budsjett/Slettbudsjett.php' method='post' class='slett$Id'>
                <input type='hidden' name='Item' value='$Item'>
                <input type='hidden' name='Sum' value='$Sum'>
                <input type='hidden' name='Id' value='$Id'>
                <input type='submit' value='&times;' class='deleteupdatebutton'>
                </form></div>$Item</td>" ;
                 echo "<td class='tabellcelle'  id=''>
                 <span style='float: right' class='deleteupdatebutton' id='close$Id'>&times;</span>
                 <form action='Actionfiler/Budsjett/Oppdaterbudsjett.php' method='post'>
                 <input type='number' value='$Sum' name='Sum'>
                 <input type='hidden' value='$Id' name='Id'>
                 <input type='hidden' value='$Item' name='Item'>
                 <input type='submit' value='Oppdater' class='button'>
                 </form>
                 </td></tr>
                 <script>
                 var open = document.getElementById('open$Id');
                 var close = document.getElementById('close$Id');
                 var rowa$Id= document.getElementById('row1-$Id');
                 var rowb$Id = document.getElementById('row2-$Id');

                 open.onclick = function(){
                   rowa$Id.style.display = 'none';
                   rowb$Id.style.display= 'table-row';
                 }
                 close.onclick = function(){
                   rowa$Id.style.display = 'table-row';
                   rowb$Id.style.display= 'none';
                 }
                 </script>";
               }}}

            $SQL="SELECT * FROM `haldenvg_it`.`budsjett` WHERE `Kategori`='Annet'";  //HENT INNTEKTSTABELL
                $resultat=$tilkobling->query($SQL) ;
                $sjekkbudsjett = mysqli_query($tilkobling, "SELECT count(*) FROM `budsjett` WHERE `Kategori`='Annet'");
                  while ($rad=$sjekkbudsjett->fetch_array()){
                    $antall=$rad[0];
                  }
                  if ($antall>0) {
               echo "<tr>" ;
               echo "<th class='tabellcelle'  colspan='2' style='text-align: left;'>Diverse</th>" ;
               echo "</tr>" ;

               while ($rad=$resultat->fetch_assoc()) {
                 $Item  =$rad["item"] ;
                 $Sum=$rad["sum"] ;
                 $Id=$rad["id"];
                    echo "<tr id='row1-$Id'>" ;
                    echo "<td class='tabellcelle hoverbox$Id'>";
                    if (isset($_SESSION['Brukernavn'])) {
                      echo"
                      <div class='pbhover' style='float:left;'>
                     <span class='navn' id='popup$Id'>Slett</span>
                     <form  action='Actionfiler/Budsjett/Slettbudsjett.php' method='post' class='slett$Id'>
                     <input type='hidden' name='Item' value='$Item'>
                     <input type='hidden' name='Sum' value='$Sum'>
                     <input type='hidden' name='Id' value='$Id'>
                     <input type='submit' value='&times;' class='deleteupdatebutton'>
                     </form></div>"; }
                    echo "$Item</td>" ;
                    echo "<td id='open$Id' class='tabellcelle'>$Sum,-</td>" ;
                    echo "</tr>" ;
                    if (isset($_SESSION['Brukernavn'])){
                    echo "<tr id='row2-$Id' style='display: none'>" ;
                    echo "<td class='tabellcelle hoverbox$Id'>
                    <div class='pbhover' style='float:left;'>
                   <span class='navn' id='popup$Id'>Slett</span>
                   <form  action='Actionfiler/Budsjett/Slettbudsjett.php' method='post' class='slett$Id'>
                   <input type='hidden' name='Item' value='$Item'>
                   <input type='hidden' name='Sum' value='$Sum'>
                   <input type='hidden' name='Id' value='$Id'>
                   <input type='submit' value='&times;' class='deleteupdatebutton'>
                   </form></div>$Item</td>" ;
                    echo "<td class='tabellcelle'  id=''>
                    <span style='float: right' class='deleteupdatebutton' id='close$Id'>&times;</span>
                    <form action='Actionfiler/Budsjett/Oppdaterbudsjett.php' method='post'>
                    <input type='number' value='$Sum' name='Sum'>
                    <input type='hidden' value='$Id' name='Id'>
                    <input type='hidden' value='$Item' name='Item'>
                    <input type='submit' value='Oppdater' class='button'>
                    </form>
                    </td></tr>
                    <script>
                    var open = document.getElementById('open$Id');
                    var close = document.getElementById('close$Id');
                    var rowa$Id= document.getElementById('row1-$Id');
                    var rowb$Id = document.getElementById('row2-$Id');

                    open.onclick = function(){
                      rowa$Id.style.display = 'none';
                      rowb$Id.style.display= 'table-row';
                    }
                    close.onclick = function(){
                      rowa$Id.style.display = 'table-row';
                      rowb$Id.style.display= 'none';
                    }
                    </script>";
                  }}}
         echo "</table></div>";
         echo "</div><div class='col-12' style='display: flex; justify-content: center;'><div class='col-6 col-t-10 col-m-12' id='budsjettbuttons'>";
       }
       else {
         echo "<p>Ingen eksisterende verdier</p>";
       }
         if (isset($_SESSION['Brukernavn'])){
        echo "<button style='float: right;' href=''class='button'  id='Budsjettbtn'>Legg til</button>";
      }
      if ($antall<0) {
      $SQL2=mysqli_query($tilkobling,"SELECT SUM(Sum) AS 'value_sum' FROM `haldenvg_it`.`budsjett`");
      while ($rad=$SQL2->fetch_assoc()){
        echo "<h3>";
        echo $rad['value_sum'];
        echo ",-</h3>";
      }
    }
      echo "</div>";
      if (isset($_SESSION['Brukernavn'])) {
        echo "
        <div id='BudsjettModal' class='modal'>
          <div class='modal-content'>
            <span class='close' onclick='closemodal()'>&times;</span>
            <div class='modalform'>
            <form id='utgift' class= 'skjul' action='Actionfiler/Budsjett/Leggtilbudsjett.php' method='post' formtarget='Innhold'>
            <h2>Legg til i budsjett</h2>
            <table>
              <tr>
                <td>Navn:</td>
                <td><input type='text' name='Item' required=''></td>
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
            <tr class='btncell'><td><br><input class='button' type='submit' value='Legg til'></td></tr>
            </table>
    </form>
    </div>
    </div>
    </div>
    <br>";
    echo "<script>
    var budsjettmodal = document.getElementById('BudsjettModal');
    var budsjettbtn= document.getElementById('Budsjettbtn')
    var span = document.getElementsByClassName('close')[1];
    budsjettbtn.onclick =function() {
      budsjettmodal.style.display = 'block';
    }
    function closemodal() {
    budsjettmodal.style.display = 'none';
    }
    budsjettmodal.onclick = function(ev) {
          if(ev.target.className !== 'modal-content' && ev.target.className == 'modal' ){
             budsjettmodal.style.display = 'none';
          }
    }
    </script>";
  }
  echo "</div>";

include 'footer.php'; ?>
<script src="Russebudsjett.js"></script>
<script>
document.getElementsByClassName('tab')[0].setAttribute('src', 'Assets/a_tab.png');
document.getElementsByClassName('tab')[0].id = 'active';
document.getElementById('bud').className = 'box active';
</script>
  </table>
</body>
</html>
