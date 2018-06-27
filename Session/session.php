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
    Username: <input type="text" name="" value="<?php echo $usr; ?>" readonly> <button type="button" name="usr" class="edit">Edit</button> <br>
    Display name: <input type="text" name="" value="<?php echo $display; ?>" readonly> <button type="button" name="display" class="edit">Edit</button>
  </body>
</html>
