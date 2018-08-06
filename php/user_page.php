<?php
  session_start();
  require 'redirect.php';
  require 'connect.php';
  require 'user_details.php';
  require 'photo_modal.php';
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
    <script>
      let app = {
        settings: {
          state: 'closed'
        },
        photo_modal: {
          state: 'closed'
        }
      };
    </script>
  </head>
  <body>
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
      <div id="add-change-user-details">add/change user details</div>
      <!-- change photo modal -->
      <?php photo_modal(); ?>
      <!-- add/change details modal -->
      <?php user_details(); ?>
      
    </div>
  </body>
  <script src="../js/application.js"></script>
</html>
