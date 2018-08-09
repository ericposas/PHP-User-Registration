<?php
  require 'grab_user_info.php';
  # var_dump($_SESSION['user_info']);
  require 'address_modal.php';
  require 'photo_modal.php';
  require 'about_me_modal.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
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
          echo "
          <div id=\"welcome-tag\">
            Welcome <span id=\"user-name-color\">".$_SESSION['username']."</span>, this is your home page.<br>
          </div>";
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
        ?>" width="80" draggable="false">
      <div id="user-details">
        <br>
        <div id="details-tag">
          <?php
            if(isset($_SESSION['username'])){
              echo $_SESSION['username']." details";
            }
          ?>
        </div>
        <br>
        <div id="user-email">
          <?php
            if(isset($_SESSION['user_info'])){
              echo "<div id=\"user-email-tag\">E-mail:</div>";
              echo "<div id=\"user-email-content\">".$_SESSION['user_info']['email']."</div>";
            }
          ?>
        </div>
        <br>
        <div id="user-address">
          <?php
            if(isset($_SESSION['user_info'])){
              echo "<div id=\"user-address-tag\">Address:</div>";
              echo "<div id=\"user-address-content\">".$_SESSION['user_info']['address'].", "
              .$_SESSION['user_info']['state']
              .", ".$_SESSION['user_info']['zipcode']
              ."</div>";
            }
          ?>
        </div>
        <br>
        <div id="user-blurb">
          <?php
            if(isset($_SESSION['blurb'])){
              echo
                "<div id=\"user-blurb-tag\">About me:</div>"
                ."<div id=\"user-blurb-content\">".$_SESSION['blurb']."</div>";
            }
          ?>
        </div>
      </div>
    </div>
    
    <div id="dimmer"></div>
    
    <!-- SETTING MODAL (gear in top right corner) -->
    <div id="settings">
      <div id="settings-close-button">x</div>
      <div id="profile-photo-change" class="update-button">change profile photo</div>
      <div id="add-change-email" class="update-button">add/change email</div>
      <div id="add-change-address" class="update-button">add/change address</div>
      <div id="about-me-update" class="update-button">update about me blurb</div>
      <!-- change photo modal -->
      <?php
        photo_modal();
        # change email modal 
        echo "
          <div id=\"change-email-modal\">
            <div id=\"change-email-modal-close-button\">x</div>
            <form method=\"post\" action=\"process_email_info.php\">
              <span class=\"input-label email-label\">E-mail:</span>
              <br>
              <input type=\"text\" name=\"email\" placeholder=\"firstlast@somecompany.com\">
              <br>
              <input type=\"submit\" value=\"Submit e-mail\">
            </form>
          </div>
        ";
        # add/change address modal 
        user_address_modal();
        # about blurb 
        about_me_modal();
        
      ?>
    </div>
  </body>
  <script src="../js/application.js"></script>
</html>
