<?php

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
      <form action="process.php" method="POST">
        <center>
          Register now!<br><br>
          <input type="text" name="usr" placeholder="Username*" required><br>
          <input type="text" name="display" placeholder="Dispay name*" required><br>
          <input type="password" name="pwd" placeholder="Password*" required><br>
          <div class="p"></div>
           <br><br>
          <input type="submit" name="type" value="register"><br><br>
          Already have an account?<br>
          <a href="/login.php">Go here!</a>
      </center>
      </form>
  </center>
  </body>
</html>
