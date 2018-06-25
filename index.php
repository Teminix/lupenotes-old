<?php
// if type = register
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $prompt = "";
  $usr = $_POST["usr"]; // receive variable 'usr'
  $display = $_POST["display"]; // receive variable 'display'
  $pwd  = $_POST["pwd"];//  receive variable 'pwd'
  if (strlen($usr) < 6 || strlen($display) < 6 || strlen($pwd) < 6) { // if Character expectation less then:
    $prompt = "Username, display and password must be at least 6 characters";
  }
  else { // otherwise:
    $conn = new mysqli("localhost","root","root","project"); // use OOP style to establish connection;
    $query = "SELECT * FROM users WHERE usr='$usr'";
    $res = $conn->query($query); // Query the $query variable
    $check = $res->num_rows; // Calculate number of received rows as $check
    if ($check == 1) {//if user exists
      $prompt = "User with username ".$usr." already exists. If you want to login, <a href='/login.php'>Go here</a>";
    }
    if ($check == 0) {//if not
      $query = "INSERT INTO users (usr,display,pwd) VALUES ('$usr','$display','$pwd')"; // insert user query
      $res = $conn->query($query); // execut $query and store in $res just in case
      $_SESSION["usr"] = $usr;
      $_SESSION["display"] = $display;
      $_SESSION["pwd"] = $pwd;
      header("location:Session/session.php");
    }
  }
}


 ?>






<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Registration page</title>
    <link rel="stylesheet" href="/styles/main.css">

    <script type="text/javascript">

    </script>
  </head>
  <body>
    <center>
      <form action="index.php" method="POST">
        <center>
          Register now!<br><br>
          <input type="text" name="usr" placeholder="Username*" required><br>
          <input type="text" name="display" placeholder="Dispay name*" required><br>
          <input type="password" name="pwd" placeholder="Password*" required><br>
          <div class="p"><?php echo $prompt ?></div>
           <br><br>
          <input type="submit" name="type" value="register"><br><br>
          Already have an account?<br>
          <a href="/login.php">Go here!</a>
      </center>
      </form>
  </center>
  </body>
</html>
