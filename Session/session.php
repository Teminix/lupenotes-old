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
      function keyDown(event, keycode, func) {
        if (event.keyCode == keycode){func};
      };
      function changePass() {
          var old_pass = document.getElementsByName("password")[0].value;
          var new_pass = document.getElementsByName("password")[1].value;
          $.ajax ({
            type:"POST",
            url:"changes.php",
            data: {op:old_pass,np:new_pass,type:"password"},
            success: function (data) {
              if (data == "1") {
                modal[1].style.display = "none";
                window.location.reload(true);
              }
              else {
                prompts[1].innerHTML = data;
              }
            },
            error: function () {
              prompts[1].innerHTML = "Some error occured in trying to change your password";
            }
          });

      }
      function changeUsr() {

          var user = document.getElementById("usr").value;
          var displayName = document.getElementById("display").value;
          var pass = document.getElementById("pass").value;
          $.ajax({
            type:"POST",
            url:"changes.php",
            data: { usr:user,display:displayName,pwd:pass,type:"username" },
            success: function (data) {
              if (data == "1") {
                modal[0].style.display="none";
                window.location.reload(true);
              }
              else {
                document.getElementsByClassName('p')[0].innerHTML = data;
              }
            },
            error: function() {
              document.getElementsByClassName('p')[0].innerHTML = "Some error occured in the server";
            }
          });

      }
    </script>
  </head>
  <body>
    <div class="main">
      <?php
      $conn = new mysqli("localhost","root","root","project");
      $res = $conn->query("SELECT * FROM users WHERE usr='".$_SESSION["usr"]."'");
      $row = $res->fetch_assoc();
      if ($row["image"] == '') {
        echo "<img src='../dps/default.jpg'>";
      }
      else {
        echo "<img src='../dps/".$row["image"]."'>";
      }

       ?>
    <br>
    <span>Username: <input type="text" name="usr" value="<?php echo $usr; ?>" readonly> </span> <br>
    <span>Display name: <input type="text" name="display" value="<?php echo $display; ?>" readonly> </span><br><br>
    <button type="button"><a href="logout.php">Log Out</a></button>
    <button type="button" name="display" class="edit">Edit Profile</button> <!-- First edit button -->
    <button type="button" name="pass" class="edit">Change Password</button> <!-- Second edit button -->
    <button type="button" name="profile">Change profile picture</button>
  </div>
  <div class="modal"> <!-- MODAL DIVISION 1 -->
    <div class="content">
      <form>
        <br><br>
        Edit user and Display name:<br><br>
        <span class="div"><input type="text" name="usr" value="" placeholder="Username" id="usr" onkeypress="if(event.keyCode ==13){changeUsr()}"></span><br>
        <span class="div"><input type="text" name="display" value="" placeholder="Display Name" id="display" onkeypress="if(event.keyCode ==13){changeUsr()}"></span><br>
        <span class="p"></span>
        <br><br>
        Verify Changes with password<br><br>
        <span class="div"><input type="password" name="pwd" placeholder="Password" id="pass" onkeypress="if(event.keyCode ==13){changeUsr()}"></span><br><br>
        <button type="button" class="cancel">Cancel</button> <!-- First cancel button -->
        <button type="button" class="verify">Verify</button> <!-- First verify button-->
    </form>
    </div>
  </div>
  <div class="modal"> <!-- MODAL DIVISION 2 -->
    <div class="content" style="width:30%">
      <form>
        Change Password:<br><br>
        <span class="div"><input type="password" name="password" placeholder="Old password" onkeypress="if(event.keyCode ==13){changePass()}"> </span><br><br>
        <span class="div"><input type="password" name="password" placeholder="New password" onkeypress="if(event.keyCode ==13){changePass()}"> </span><br><br>
        <span class="p"></span><br><br>
        <button type="button" class="cancel">Cancel</button><!-- Second cancel button-->
        <button type="button" class="verify">Change password</button> <!-- Second verify button-->
    </form>
    </div>
  </div>
  <div class="modal"> <!-- MODAL DIVISION 3 -->
    <div class="content" style="width:35%">
      <form action="changes.php" method="POST" enctype="multipart/form-data">
        Change profile picture:<br><br>
          <input type="file" accept="image/*" name="fileupload"><br><br>
          <img id="prev"><br><br>
          <span class="p"></span>
          <button type="button" name="clear">Reset Picture</button><br>
          <button type="button" class="cancel">Cancel</button>
          <button type="submit" name="type" value="profile">Update Profile Pic</button>
    </form>
    </div>
  </div>
    <script type="text/javascript">


      var prompts = document.getElementsByClassName("p");
      var modal =document.getElementsByClassName('modal');
      var modalContent = document.getElementsByClassName('content')[0];
      var edit_button = document.getElementsByClassName('edit');
      var cancel_button = document.getElementsByClassName('cancel');
      var verify_button = document.getElementsByClassName('verify');
      var update_button = document.getElementsByName('profile');
      var img_input = document.getElementsByName("fileupload");
      var clear_img = document.getElementsByName("clear");
      edit_button[0].onclick = function () {
        modal[0].style.display = "block";
        document.getElementsByName('usr')[1].value = document.getElementsByName('usr')[0].value;
        document.getElementsByName('display')[2].value = document.getElementsByName('display')[0].value;
      };
      edit_button[1].onclick = function () {
        modal[1].style.display = "block";
      }
      cancel_button[0].onclick = function () {
        modal[0].style.display = "none";
        prompts[0].innerHTML = "";
      };
      cancel_button[1].onclick = function () {
        modal[1].style.display = "none";
        prompts[1].innerHTML = "";
      };
      cancel_button[2].onclick = function() {
        modal[2].style.display = "none";
      };
      verify_button[1].onclick = function () {changePass()};
      verify_button[0].onclick = function() {changeUsr()};
      update_button[0].onclick = function () {
        modal[2].style.display = "block";
      }
      img_input[0].onchange = function() {
        const reader = new FileReader();
        reader.readAsDataURL(img_input[0].files[0])
        reader.onload = function () {
          img = document.getElementById("prev");
          img.setAttribute("src",reader.result);
        }
      }
      clear_img[0].onclick = function () {
        $.ajax({
          type:"POST",
          url:"changes.php",
          data: {clear:"TRUE"},
          success: function (data) {
            //prompts[2].innerHTML = data;
            window.location.reload(true);
          },
          error: function () {
            prompts[2].innerHTML = "Some error has occured";
          }
        });
      }



    </script>
  </body>
</html>
