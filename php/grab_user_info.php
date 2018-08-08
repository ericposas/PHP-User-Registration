<?php

  session_start();

  require 'redirect.php';
  require 'connect.php';
  
  // set user photo if one exists
  if(!isset($_SESSION['photo'])){
    $stmt = $conn->prepare("SELECT `photo` FROM `users` WHERE `username` = ?");
    $stmt->bind_param("s", $_SESSION['username']);
    if($stmt->execute()){
      $stmt->bind_result($photo);
      if($stmt->fetch() > 0){
        $_SESSION['photo'] = $photo;
        $stmt->close();
      }else{
        echo $stmt->error;
      }
    }
  }

  $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
  $stmt->bind_param("s", $_SESSION['username']);
  if($stmt->execute()){
    $stmt->bind_result($id);
    if($stmt->fetch() > 0){
      $_SESSION['id'] = $id;
      $stmt->close();
      get_user_info($id);
    }else{
      echo $stmt->error;
    }
  }
  
  function get_user_info($id){
    global $conn;
    $stmt = $conn->prepare("
      SELECT email, address, zipcode, state 
      FROM user_info
      WHERE id = ?
    ");
    $stmt->bind_param("i", $_SESSION['id']);
    if($stmt->execute()){
      $stmt->bind_result($email, $address, $zipcode, $state);
      while($stmt->fetch()){
        # echo $email." ".$address." ".$zipcode." ".$state;
        $user_info = array(
          'email' => $email,
          'address' => $address,
          'zipcode' => $zipcode,
          'state' => $state
        );
        $_SESSION['user_info'] = $user_info;
        # var_dump($_SESSION['user_info']);
      }
      $stmt->close();
    }else{
      $stmt->error;
    }
  }

?>