<?php

session_start();

require 'redirect.php';
require 'connect.php';

$email_set = 0;
$address_set = 0;
$zipcode_set = 0;
# $state_set = 0;

if(isset($_POST['email']) && !empty($_POST['email'])){
  $email = $_POST['email'];
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format";
    redirect_to("./user_page.php");
  }else{
    $email_set = 1;
  }
}else{
  echo "Please enter an e-mail";
  redirect_to("./user_page.php");
}

if($email_set > 0){
  if(isset($_POST['address']) && !empty($_POST['address'])){
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $address_set = 1;
  }else{
    echo "Please enter an address";
    redirect_to("./user_page.php");
  }
}

if($address_set > 0){
  if(isset($_POST['zipcode']) && !empty($_POST['zipcode'])){
    $zipcode = $_POST['zipcode'];
    if(!preg_match("/\d{5}/", $zipcode)){
      echo "Invalid Zipcode";
      redirect_to("./user_page.php");
    }else{
      $zipcode_set = 1;
    }
  }else{
    echo "Please enter your zipcode";
    redirect_to("./user_page.php");
  }
}

if($zipcode_set > 0){
  if(isset($_POST['state'])){
    $state = $_POST['state'];
    get_user_id();
  }else{
    echo "Please select a State";
    redirect_to("./user_page.php");
  }
}


function get_user_id(){
  global $conn;
  $stmt = $conn->prepare("SELECT `id` FROM `users` WHERE `username` = ?");
  $stmt->bind_param("s", $_SESSION['username']);
  if($stmt->execute()){
    $stmt->bind_result($id);
    if($stmt->fetch() > 0){
      $_SESSION['id'] = $id;
      $stmt->close();
      database_enter_info($id);
    }else{
      echo $stmt->error;
      redirect_to("user_page.php");
    }
  }
}

function database_enter_info($id){
  global $conn, $email, $address, $zipcode, $state;
  $stmt = $conn->prepare("UPDATE `user_info` SET `email`=?, `address`=?, `zipcode`=?, `state`=? WHERE `id` = ?");
  $stmt->bind_param("ssisi", $email, $address, $zipcode, $state, $id);
  if($stmt->execute()){
    echo "Data entered successfully!";
    $stmt->close();
    redirect_to("user_page.php");
  }else{
    echo $stmt->error;
    redirect_to("user_page.php");
  }
}

