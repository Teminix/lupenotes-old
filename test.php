<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $usr = $_POST["usr"];
  $pwd = $_POST["pwd"];
  $display = $_POST["display"];
  if (strlen($usr) < 6 ||strlen($pwd) < 6 ||strlen($display) < 6) {
    echo "Display name, username and password must be at least six characters long";
  }
  else {
    echo "Username: ".$usr."\n";
    echo "Password: ".$pwd."\n";
    echo "Display name: ".$display."\n";}
}
else {
  header("location:index.php");
}
 ?>
