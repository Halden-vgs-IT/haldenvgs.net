<?php
      $hentinntekt=mysqli_query($tilkobling, "SELECT SUM(`Inntekt`) FROM `inntekt`;");
      while ($rad=$hentinntekt->fetch_array()){
        $inntekt=$rad[0];
        if ($inntekt==NULL) {
          $inntekt = 0;
        }
      }
      $hentbudsjett=mysqli_query($tilkobling, "SELECT SUM(`sum`) FROM `budsjett`;");
      while ($rad=$hentbudsjett->fetch_array()){
        $sum=$rad[0];
        if ($sum==NULL) {
          $sum = 0;
        }
      }
      $hentsponsor=mysqli_query($tilkobling, "SELECT SUM(`sum`) FROM `sponsor`;");
      while ($rad=$hentsponsor->fetch_array()){
        $sponsor=$rad[0];
        if ($sponsor==NULL) {
          $sponsor = 0;
        }
      }
      $Nr=$sponsor+$inntekt;
      $Pros = ($Nr/$sum)*100 ;
      $Rest = (100-$Pros);
      if ($sum == 0) {
        $Pros = 100;
      }
      if ($Nr == 0) {
        $Pros = 0;
      }
      ?>
    </div>
    <footer class="col-12" style='position: ; bottom: ;'>
      <div id="progressbar">
      <p class="label labelleft"><?php echo $Nr; echo ",-";?></p>
      <div id="border">
       <div id="bar" style="width:<?php echo $Pros;  ?>%;" >
        <p id="text"><?php echo round($Pros, 1); echo "%";?></p>
       </div>
     </div>
      <p class="label labelright"><?php echo "$sum,-" ?></p>
    </div>
    <table id='extralabels' class="col-12">
      <tr class="col-12">
      <td class='col-6' id='leftlabel' style='text-align: left; ;'><?php echo $Nr; echo ",-";?></td>
      <td class='col-6' id='rightlabel' style='text-align: right; ;'><?php echo $sum; echo ",-" ?></td>
    </tr>
    </table>
    </footer>

      <?php
      if ($Pros < 5) {
      echo "<script>document.getElementById('text').style.marginLeft='60px'</script>";
      }
      ?>
