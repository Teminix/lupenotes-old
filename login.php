<?php
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $usr = $_POST["usr"];
    $pwd  = $_POST["pwd"];
    $prompt = "";
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

 ?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Login page</title>
    <link rel="stylesheet" href="/styles/main.css">
    <style media="screen">

    </style>
    <script type="text/javascript">

    </script>
  </head>
  <body>
    <center>
      <form action="login.php" method="POST">
        <center>
          Login now!<br><br>
          <input type="text" name="usr" placeholder="Username" required><br>
          <input type="password" name="pwd" placeholder="Password" required><br>
          <div class="p">
            <?php echo $prompt ?>
          </div> <br><br>
          <input type="submit" name="type" value="login"><br><br>
          Don't have an account?<br>
          <a href="/index.php">Go here!</a>
      </center>
      </form>
  </center>
  </body>
</html>
