<?php
session_start();
if(!(isset($_SESSION["usr"]) == "TRUE" || isset($_SESSION["display"]) == "TRUE")) {
  header("location:../index.php");
}
else {
  $usr = $_SESSION["usr"];
  $display = $_SESSION["display"];
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Your Session</title>
  </head>
  <body>
    Username: <?php echo $usr; ?><br>
    Display name: <?php echo $display; ?>
  </body>
</html>
