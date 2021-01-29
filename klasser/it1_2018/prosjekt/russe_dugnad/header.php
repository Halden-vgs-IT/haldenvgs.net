<header id="header" class="col-12">
  <a id="menuButton" style='color: white;' unselectable="on" onclick="clicked()">&#9776;</a>
  <div class="headertext"><p id="overskrift">RUSSEBUDSJETT</p></div>
  <div class="headerlogginn">
  <?php
  include 'connection.php';
  ?>
  <?php
  if (isset($_SESSION['Brukernavn'])) {
  $Brukernavn = $_SESSION["Brukernavn"];
  $sjekkbilde = mysqli_query($tilkobling, "SELECT count(*) FROM `profilbilde` WHERE `Brukernavn`='$Brukernavn'");
  $row=$sjekkbilde->fetch_array();
    if ($row[0]==1){
       $hentpb=mysqli_query($tilkobling, "SELECT `image` FROM `haldenvg_it`.`profilbilde` WHERE `Brukernavn`='$Brukernavn'");
         while ($rad=$hentpb->fetch_assoc()){
           echo "<a style='height: 100%; display: block; text-decoration: none; color: #fd5158;' href='Profil.php?Brukernavn=$Brukernavn'><div style='display: flex; align-items: center;
           height: 100%;'>";
           echo '<img src="data:image/jpeg;base64,'.base64_encode( $rad['image'] ).'" class="pbheader">';
           echo "<p class='navnheader'>$Brukernavn</p>";
           echo "</div></a>";
         }
      }
   elseif ($row[0]==0) {
     echo "<a style='height: 100%; display: block; text-decoration: none; color: #fd5158;' href='Profil.php?Brukernavn=$Brukernavn'><div style='display: flex; align-items: center;
     height: 100%;'>";
        echo "<img class='pbheader' src='Assets/Defaultpb.jpg'>";
        echo "<p class='navnheader'>$Brukernavn</p>";
        echo "</div></a>";
     }
  }

  ?>
  <button href=""class="logginn"  id="Modalbtn"  onclick="logginn()">Logg inn</button></div>
</header>
   <nav>
     <ul id="menu">
       <li>
         <a href="index.php">
           <div id='hjem' class="box" onmouseover="homeHover()" onmouseout="homeUnhover()">
             <img class="icons home"  src="Assets/home.png" alt="HomeButton">
             Hjem
           </div>
       </a>
       </li>
       <li>
         <a href="Dugnader.php">
           <div id='dug' class="box" onmouseover="workHover()" onmouseout="workUnhover()">
             <img  class="icons work" src="Assets/work.png" alt="Dugnader">
             Dugnader
           </div>
       </a>
       </li>
       <li>
         <a href="Inntektogutgifter.php">
           <div id='inn' class="box" onmouseover="moneyHover()" onmouseout="moneyUnhover()">
             <img style="width: auto; height: 120px;" class="icons money" src="Assets/money.png" alt="Inntekt og utgifter">
             Inntekt og utgifter
           </div>
         </a>
       </li>
       <li>
         <a href="Budsjett.php">
           <div id='bud' class="box" onmouseover="tabHover()" onmouseout="tabUnhover()">
             <img  class="icons tab" src="Assets/tab.png" alt="Budsjett">
             Budsjett
           </div>
         </a>
       </li>
       <li>
         <a href="Landstreff.php">
           <div id='land' class="box" onmouseover="norHover()" onmouseout="norUnhover()">
             <img class="icons nor" src="Assets/norway.png" alt="Landstreff">
             Landstreff
           </div>
         </a>
       </li>
       <li>
         <div id='pro' class='dropdown box' onmouseover="profileHover()" onmouseout="profileUnhover()">
           <img class='icons profile' src='Assets/profile.png' alt='Profil'>
           <div class='flex'>
           <a class='profilmenu'>Profil <img class='profilmenu' id="arrow" src="Assets/dropdown.png" alt="Pil ned"></a>
           <div class='dropdown-content' id='dropdown-content'>
             <?php
              $hentprofil = mysqli_query($tilkobling, "SELECT `Brukernavn` FROM `logginn` ORDER BY length(`Brukernavn`) DESC");
              while ($rad = $hentprofil->fetch_assoc()) {
                $profil = $rad["Brukernavn"];
                echo "<a class='profil' href='Profil.php?Brukernavn=$profil'>$profil</a>";
              }
             ?>
           </div>
         </div>
         </div>
       </li>
     </ul>
   </nav>
<?php
if (!isset($_SESSION['Brukernavn'])) {
echo "  <div id='myModal' class='modal'>
<div class='modal-content'>
  <span class='close' onclick='closeloginform()'>&times;</span>
  <div class='modalform'>
  <form id='skjema' action='Actionfiler/Logg_inn.php' method='post'>
    <h2>Logg inn</h2>
      <table>
        <tr>
          <td>Navn:</td>
          <td><input  id='brukernavn' type='text' name='Brukernavn' required=''><br></td>
       </tr>
       <tr>
         <td>Passord:&emsp;</td>
         <td><input id='passord' type='password' name='Passord' required=''></td>
       </tr>
       <tr class='btncell'><td><br>
      <input class='button' name='send' type='submit' value='Logg inn' formtarget=''>
      </td><td style='padding-top: 20px'><a style='color: white; text-decoration: underline;' href='Registrer.html'>Ny bruker</a></td></tr>
      </table>
  </form>
</div>
</div>
</div>"; }
?><?php
if (isset($_SESSION['Brukernavn'])) {

echo "<script>
    function endrelogginnknapp() {
      document.getElementById('Modalbtn').innerHTML='Logg ut';
      document.getElementById('Modalbtn').setAttribute('onclick','loggut()')}
      window.onload = endrelogginnknapp();";
echo "function loggut() {
   window.location = 'Actionfiler/Logg_ut.php'; }</script>";
}
?>
