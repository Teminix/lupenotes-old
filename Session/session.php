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
    <title><?php echo $usr ?>'s Profile</title>
    <link rel="stylesheet" href="styles.css">
    <script src="../scripts/Libraries/jquery.js" charset="utf-8"></script>
    <script type="text/javascript">

    </script>
  </head>
  <body>
    <div class="main">
    <span>Username: <input type="text" name="" value="<?php echo $usr; ?>" readonly> </span> <br>
  <span>Display name: <input type="text" name="" value="<?php echo $display; ?>" readonly> </span><br><br>
    <button type="button"><a href="logout.php">Log Out</a></button>
    <button type="button" name="display" id="edit">Edit</button>
  </div>
  <div class="modal">
    <div class="content">
      <span class="div"><input type="text" name="usr" value="" placeholder="Username"></span><br>
      <span class="div"><input type="text" name="display" value="" placeholder="Display Name"></span><br><br>
      Verify Changes with password<br><br>
      <span class="div"><input type="password" name="pwd" placeholder="Password"></span><br><br>
      <button type="button" id="cancel">Cancel</button>
      <button type="button" id="verify">Verify</button>
    </div>
  </div>
    <script type="text/javascript">

      var modal =document.getElementsByClassName('modal')[0];
      var modalContent = document.getElementsByClassName('content')[0];
      var edit_button = document.getElementById('edit');
      var cancel_button = document.getElementById('cancel');
      var verify_button = document.getElementById('verify');

      edit_button.onclick = function () {
        modal.style.display = "block";
      };
      cancel_button.onclick = function () {
        modal.style.display = "none";
      };

    </script>
  </body>
</html>
