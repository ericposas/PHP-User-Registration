<?php

session_start();

require 'connect.php';

# BACK-END PROCESSING 

# check db for blurb data 
$stmt = $conn->prepare("SELECT `blurb` FROM users WHERE username = ?");
$stmt->bind_param("s", $_SESSION['username']);
if($stmt->execute()){
  $stmt->bind_result($result);
  while($stmt->fetch()){
    $_SESSION['blurb'] = $result;
  }
  $stmt->close();
}

# if blurb data from SQL returns null, enter form data into db 
if(isset($_POST['blurb'])){
  $post_data = nl2br(filter_var($_POST['blurb'], FILTER_SANITIZE_STRING));
  enter_blurb_into_db();
}

function enter_blurb_into_db(){
  global $conn, $post_data;
  $stmt = $conn->prepare("UPDATE users SET `blurb` = ? WHERE username = ?");
  $stmt->bind_param("ss", $post_data, $_SESSION['username']);
  if($stmt->execute()){
    header("Location: user_page.php");
    $stmt->close();
  }
}

# FRONT-END MODAL

function about_me_modal(){
  # processes the blurb info on the same page as the front-end modal is generated on 
  echo "
    <div id=\"about-me-modal\">
    <div id=\"about-me-modal-close-button\">x</div>
      <form method=\"post\" action=\"./about_me_modal.php\">
        <textarea name=\"blurb\">".strip_tags($_SESSION['blurb'])."</textarea>
        <br>
        <input name=\"blurb-submit\" type=\"submit\" value=\"Submit\">
      </form>
    </div>
  ";
}

