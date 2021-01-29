<?php
$servername="31.220.21.83" ;
$username="haldenvg_russ";
$password="7dt.6Ce7ycUc";
$database="haldenvg_it";

$tilkobling= new mysqli($servername,$username,$password,$database) ;
if (mysqli_connect_error())
{
  echo "<script>alert('Fikk ikke kontakt med databasen')</script>" ;
  die () ;
}
?>
