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
   <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="Russebudsjett.css">
   <style>
     #content {
       padding: 0;
     }
  </style>
</head>
<body>
  <div id="content">
<?php
include 'connection.php';
 $SQL="SELECT * FROM `haldenvg_it`.`historikk` ORDER BY `Tid` DESC";
 $resultat=$tilkobling->query($SQL) ;
 echo "<div style='width: 100%; display: flex; justify-content: center;'>";
 echo "<div style='text-align: left;'>";
 echo "<h1>Historikk</h1>";

 while ($rad=mysqli_fetch_array($resultat)) {
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
      <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 la til $Sum2,-</p>
      </div>
      </div></a>";
   }
   if ($Type==2){
        echo "
        <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
     $pb
       <div class='text'>
       <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 la til dugnaden $element</p>
       </div>
       </div></a>";
   }
   if ($Type==3){
     echo "
     <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
     $pb
    <div class='text'>
    <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 slettet dugnaden $element</p>
    </div>
    </div></a>";
   }
   if ($Type==4){
     echo "
    <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
    $pb
   <div class='text'>
   <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 oppdaterte dugnaden $element</p>
   </div>
   </div></a>";
   }
   if ($Type==5){
     echo "
     <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
    $pb
    <div class='text'>
    <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 la til $Sum2,- på dugnaden $element</p>
    </div>
    </div></a>";
   }
   if ($Type==6){
     echo "
     <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
     $pb
    <div class='text'>
    <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 la til $element som sponsor ($Sum2,-) </p>
    </div>
    </div></a>";
   }
   if ($Type==7){
     echo "
     <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
     $pb
    <div class='text'>
    <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 slettet sponsoren $element</p>
    </div>
    </div></a>";
   }
   if ($Type==8){
     echo "
     <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
     $pb
    <div class='text'>
    <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 endret utgiften $element til $Sum2,-</p>
    </div>
    </div></a>";
 }
   if ($Type==9){
     echo "
     <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
     $pb
    <div class='text'>
    <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 la til utgiften $element ($Sum2,-)</p>
    </div>
    </div></a>";
   }
   if ($Type==10){
     echo "
     <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
    $pb
    <div class='text'>
    <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 slettet utgiften $element ($Sum2,-)</p>
    </div>
    </div></a>";
   }
   if ($Type==11){
     echo "
     <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
    $pb
    <div class='text'>
    <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 endret sponsoren $element til $Sum2,- </p>
    </div>
    </div></a>";
   }
   if ($Type==12){
     echo "
     <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
     $pb
    <div class='text'>
    <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 tjente $Sum2,- på dugnaden $element</p>
    </div>
    </div></a>";
   }
   if ($Type==13){
     echo "
     <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
     $pb
    <div class='text'>
    <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 la til $element ($Sum2,-) i budsjettet</p>
    </div>
    </div></a>";
   }
   if ($Type==14){
     echo "
     <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
     $pb
    <div class='text'>
    <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 oppdaterte budsjettet. Endret $element til $Sum2,-</p>
    </div>
    </div></a>";
   }
   if ($Type==15){
     echo "
     <a href='Profil.php?Brukernavn=$navn2' class='historikklink'><div class='historikkcell'>
     $pb
    <div class='text'>
    <p class='navn'>$navn2</p><p class='tid'>$Tid2<br></p><p>$navn2 slettet $element ($Sum2,-) fra budsjettet</p>
    </div>
    </div></a>";
   }
 }
  echo "</div></div>";
?>
</body>
</html>
