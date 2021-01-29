<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Russebudsjett - Registrer</title>
<style>
form {
  margin: auto auto;
}
</style>
<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="Russebudsjett.css">
</head>
<body>
  <?php
  ini_set('display_errors', '0');
  session_start();
  session_destroy();
    $code = $_POST["code"];
    if ($code!="gEjWGq6PCq" && isset($code)) {
      echo "<script>alert('Feil kode')</script>";
      echo "<script>window.location = 'Registrer.html'</script>";
    }
    elseif (!isset($code)) {
      echo "<script>window.location = 'Registrer.html'</script>";
    }


   else {
     echo "
  <form action='Actionfiler/Profil/Registrer.php' method='post' >
    <h2>Registrer deg</h2>
      <table>
        <tr>
          <td>Navn:</td>
          <td><input type='text' name='Brukernavn' required=''></td>
        </tr>
        <tr>
          <td>Telefonnummer:&emsp;</td>
          <td><input  type='text' name='Tlfnr' required=''></td>
        </tr>
        <tr>
          <td>Epost:</td>
          <td><input type='text' name='Epost' required=''></td>
        </tr>
        <tr>
          <td>Passord:</td>
         <td><input  type='password' name='Passord' required=''></td>
        </tr>
        <tr>
          <td>Gjenta passord:</td>
          <td><input  type='password' name='Passord2' required=''></td>
        </tr>
    </table><br>
    <script>
    </script>
    <input class='button' type='submit' value='Registrer'>
  </form><br>";
}
  ?>
</body>
