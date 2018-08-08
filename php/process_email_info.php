<?php

session_start();

require 'connect.php';
require 'redirect.php';

$id = 0;

if(isset($_POST['email']) && !empty($_POST['email'])){
  $email = $_POST['email'];
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format";
    redirect_to("./user_page.php");
  }else{
    get_user_id();
  }
}else{
  echo "Please enter an e-mail";
  redirect_to("./user_page.php");
}

function get_user_id(){
  global $conn, $id;
  $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
  $stmt->bind_param("s", $_SESSION['username']);
  if($stmt->execute()){
    $stmt->bind_result($result);
    while($stmt->fetch()){
      $id = $result;
    }
    if($stmt->close()){
      enter_email_into_database();
    }
  }else{
    echo $stmt->error;
  }
}

function enter_email_into_database(){
  global $conn, $email, $id;
  $stmt = $conn->prepare("UPDATE user_info SET `email`=? WHERE `id`=?");
  $stmt->bind_param("si", $email, $id);
  if($stmt->execute()){
    echo "User email updated!";
    redirect_to("user_page.php");
    $stmt->close();
  }else{
    echo $stmt->error;
  }
}
