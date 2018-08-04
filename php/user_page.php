<?php
  session_start();
  require 'redirect.php';
  require 'connect.php';
  // set user photo if one exists
  $stmt = $conn->prepare("SELECT `photo` FROM `users` WHERE `username` = ?");
  $stmt->bind_param("s", $_SESSION['username']);
  if($stmt->execute()){
    $stmt->bind_result($photo);
    if($stmt->fetch() > 0){
      $_SESSION['photo'] = $photo;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link href="../css/user_page.css" rel="stylesheet">
    <script src="../js/settings-modal.js"></script>
    <script src="../js/profile-photo.js"></script>
    <script src="../js/user_page.js"></script>
  </head>
  <body onload="setup_userpage();">
    <?php if(isset($_SESSION['username'])){ ?>
      <img id="gear" src="../icons/gear.png" draggable="false">
      <form method="post" action="logout.php">
        <input id="logout_btn" type="submit" value="Logout">
      </form>
    <?php } ?>
    <div>
      <?php
        if(isset($_SESSION['username'])){
          echo "Welcome ".$_SESSION['username'].", this is your home page.<br>";
        }else{
          echo "This page is for users only.";
          redirect_to('../index.php');
        }
      ?>
      <img id="profile-photo" src="
        <?php
          if(isset($_SESSION['photo']) && !empty($_SESSION['photo'])){
            echo "../Users/".$_SESSION['username']."/profile_photo"."/".$_SESSION['photo'];
          }
        ?>" width="100" draggable="false">
    </div>
    <div id="settings">
      <div id="settings-close-button">x</div>
      <div id="profile-photo-change">change profile photo</div>
      <div id="profile-photo-modal">
        <div id="profile-photo-modal-close-button">x</div>
        <form enctype="multipart/form-data" method="post" action="upload_photo.php">
          <input type="file" name="file">
          <input id="upload_btn" type="submit" value="Upload">
        </form>
      </div>
    </div>
  </body>
</html>
