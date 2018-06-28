<?php
  session_start();
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_user = $_SESSION["usr"];
    $old_display = $_SESSION["display"];
    $pass = $_POST["pwd"];
    $new_user = $_POST["usr"];
    $new_display = $_POST["display"];

    $conn = new mysqli('localhost','root','root','project'); // Make a connection
    $query = "SELECT * FROM users WHERE usr='$old_user'"; // Make the query variable
    $res = $conn->query($query); // Result of the query

    $row = $res->fetch_assoc(); // fetch the associated row of the query result and return as array
    $id = $row["ID"];
    /*echo $row["usr"]." is your user<br>";
    echo $row["display"]." is your display<br>";
    echo $row["pwd"]." is your password<br>";*/
    if ($pass == $row["pwd"]) {
      if((strlen($new_user) < 6 || strlen($new_display) < 6) || (strlen($new_user) > 20 || strlen($new_display) > 20)) {
        echo "New Username and display name must be at least 6 characters and at max 20 characters";
      }
      else {
        $new_user_check = $conn->query("SELECT * FROM users WHERE NOT ID='$id' AND usr='$new_user'");
        $new_user_check = $new_user_check->num_rows;
        if ($new_user_check == 1) {
          echo "Another user has the username: ".$new_user;
        }
        if ($new_user_check == 0) {
        $query = "UPDATE users SET usr='$new_user', display='$new_display' WHERE ID=".$row["ID"];
        $res = $conn->query($query);
        $_SESSION["usr"] = $new_user;
        $_SESSION["display"] = $new_display;
        echo "1";}}
      }
    else {
      echo "Wrong password, try again.";
    }

  }
  else {
    header("location:session.php");
  }

 ?>
