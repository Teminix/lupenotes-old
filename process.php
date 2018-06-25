<?php
session_start();
$prompt = "prompt"; //Set the prompt variable
if(!$_SERVER['REQUEST_METHOD']=="POST") { //if method is not a post
  header("location:index.php");
}
if ($_SERVER['REQUEST_METHOD'] == "POST") { // if method is post
  $type = $_POST["type"]; // declare submission type var as $type
  if ($type == "register") {// if type = register
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
        $prompt = "Successfully registered user: <b>".$usr."</b> with display name: <b>".$display."</b><br><br><a href='Session/session.php'>Go to your page</a>";// echo success
      }
    }

  }
  if ($type == "login") {// if type = login
    $usr = $_POST["usr"];
    $pwd  = $_POST["pwd"];
    $prompt = "type = login<br>"/*.$usr." ".$pwd*/;
    $conn = new mysqli("localhost","root","root","project"); //Connect to the database 'project'
    $query = "SELECT * FROM users WHERE usr='$usr' AND pwd='$pwd'";// Here is the query
    $res = $conn->query($query);// Execute query in var "res"
    $check = $res->num_rows;// check for rows
    $row = $res->fetch_assoc();// get the row
    if ($check == 0) {// if username or password does not spit any matches
      $prompt = "Invalid username or password";
    }
    if ($check == 1) { // if username and password does match
      $_SESSION["usr"] = $row["usr"];
      $_SESSION["display"] = $row["display"];
      header("location:Session/session.php");
    }
  }
}


 ?>


<html>
  <head>
    <meta charset="utf-8">
    <title>Prompt</title>
    <link rel="stylesheet" href="styles/main.css">
  </head>
  <body>
    <div class="p">
      <h1>Prompt</h1><br><br>
      <?php echo $prompt ?>
    </div>
  </body>
</html>
