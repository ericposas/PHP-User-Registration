<?php
  require 'grab_user_info.php';
  # var_dump($_SESSION['user_info']);
  require 'user_details_modal.php';
  require 'photo_modal.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>WebFont.load({ google: {families: ['Open Sans']} });</script>
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
      <div id="user-details">
        <br>
        <div id="user-email">
          <?php
            if(isset($_SESSION['user_info'])){
              echo "<div id=\"user-email-tag\">e-mail:</div>";
              echo $_SESSION['user_info']['email'];
            }
          ?>
        </div>
        <br>
        <div id="user-address">
          <?php
            if(isset($_SESSION['user_info'])){
              echo "<div id=\"user-address-tag\">address:</div>";
              echo $_SESSION['user_info']['address'].", "
              .$_SESSION['user_info']['state']
              .", ".$_SESSION['user_info']['zipcode'];
            }
          ?>
        </div><br>
      </div>
    </div>
    <div id="settings">
      <div id="settings-close-button">x</div>
      <div id="profile-photo-change">change profile photo</div>
      <div id="add-change-user-details">add/change user details</div>
      <!-- change photo modal -->
      <?php photo_modal(); ?>
      <!-- add/change details modal -->
      <?php user_details_modal(); ?>
      
    </div>
  </body>
  <script src="../js/application.js"></script>
</html>
