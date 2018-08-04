<?php

require 'connect.php';
require 'redirect.php';

if(isset($_POST['username']) && !empty($_POST['username'])){
  if(preg_match('/^[a-zA-Z0-9]{5,}$/', $_POST['username'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    check_db_for_user();
  }else{
    echo "Only letters and numbers allowed in username";
    redirect_to("signup.php");
  }
}else{
  echo "Please enter a username of your choice";
  redirect_to("signup.php");
}

function check_db_for_user(){
  global $username, $conn, $user_exists;
  $stmt = $conn->prepare("SELECT `username` FROM `users` WHERE `username` = ?");
  $stmt->bind_param("s", $username);
  if($stmt->execute()){
    $stmt->bind_result($un);
    if($stmt->fetch() > 0){
      echo "User ".$username." exists, please choose another a unique username.<br>";
      redirect_to("signup.php");
    }else{
      continue_to_register_password();
    }
  }
}

function continue_to_register_password(){
  global $conn, $username;
  if(isset($_POST['password']) && !empty($_POST['password'])){
    if(preg_match("@[A-Z]@", $_POST['password']) &&
       preg_match("@[a-z]@", $_POST['password']) &&
       preg_match("@[0-9]@", $_POST['password'])){
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $hash = password_hash($password, PASSWORD_BCRYPT);
    }else{
      echo "Password must contain at least one number, one uppercase, one lowercase letter, be at least 8 characters in length.";
      redirect_to("signup.php");
    }
  }else{
    echo "Please make up a secure password.";
    redirect_to("signup.php");
  }

  $stmt = $conn->prepare("INSERT INTO `users`(`username`, `password`) VALUES (?, ?)");
  $stmt->bind_param("ss", $username, $hash);
  if($stmt->execute()){
    if(!is_dir("../Users/".$username)){
      mkdir("../Users/".$username, 0777, true);
      mkdir("../Users/".$username."/profile_photo", 0777, true);
    }
    redirect_to("../html/registration_successful.html", 0);
  }

  $stmt->close();
  $conn->close();
}

 ?>
