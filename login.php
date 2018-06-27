<?php

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
      <form action="process.php" method="POST">
        <center>
          Login now!<br><br>
          <input type="text" name="usr" placeholder="Username" required><br>
          <input type="password" name="pwd" placeholder="Password" required><br>
          <div class="p">
          </div> <br><br>
          <input type="submit" name="type" value="login"><br><br>
          Don't have an account?<br>
          <a href="/index.php">Go here!</a>
      </center>
      </form>
  </center>
  </body>
</html>
