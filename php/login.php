<?php

session_start();

require 'connect.php';
require 'redirect.php';

$user_exists = 0;

if(isset($_POST['username']) && !empty($_POST['username'])){
  if(preg_match("/^[a-zA-Z ]*$/",$name)) {
    $username = $_POST['username'];
    check_db_for_user();
  }else{
    echo "Only letters and white space allowed";
    redirect_to("../index.php");
  }
}else{
  echo "Please provide a username<br>";
  redirect_to("../index.php");
}

function check_db_for_user(){
  global $username, $conn, $user_exists;
  $stmt = $conn->prepare("SELECT `username` FROM `users` WHERE `username` = ?");
  $stmt->bind_param("s", $username);
  if($stmt->execute()){
    $stmt->bind_result($un);
    if(!$stmt->fetch() > 0){
      echo $username." does not exist<br>";
      redirect_to("../index.php");
    }else{
      $user_exists = 1;
    }
  }
}

if($user_exists > 0){
  if(isset($_POST['password']) && !empty($_POST['password'])){
    $password = $_POST['password'];
    check_db_for_pass();
  }else{
    echo "Please provide a password<br>";
    redirect_to("../index.php");
  }
}

function check_db_for_pass(){
  global $username, $conn;
  $stmt = $conn->prepare("SELECT `password` FROM `users` WHERE `username` = ?");
  $stmt->bind_param("s", $username);
  if($stmt->execute()){
    $stmt->bind_result($hash);
    while($stmt->fetch()){
      check_password($hash);
    }
  }
}

function check_password($hash){
  global $password, $username;
  if(password_verify($password, $hash)){
    $_SESSION['username'] = $username;
    header("Location: user_page.php");
  }else{
    echo "Incorrect password<br>";
    redirect_to("../index.php");
  }
}

?>
