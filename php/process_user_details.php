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
}

if($email_set > 0){

  if(isset($_POST['address']) && !empty($_POST['address'])){
    $address = $_POST['address'];
    /*
    if(!preg_match("/^[a-zA-Z]([a-zA-Z-]+\s)+\d{1,4}$/", $address)){
      echo "Invalid address";
      redirect_to("./user_page.php");
    }else{ */
    $address_set = 1;
    /* } */
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
  }
  
}

if($zipcode_set > 0){
  
  echo $_POST['state'];
  
  if(isset($_POST['state'])){
    $state = $_POST['state'];
    database_enter_info();
  }else{
    echo "Please select a State";
    redirect_to("./user_page.php");
  }
  
}

function database_enter_info(){
  global $conn, $email, $address, $zipcode, $state;
  $stmt = $conn->prepare("INSERT INTO `user_info`(`email`, `address`, `zipcode`, `state`) VALUES (?, ?, ?, ?) WHERE `username` = ?");
  $stmt->bind_param("sssss", $email, $address, $zipcode, $state, $_SESSION['username']);
  if($stmt->execute()){
    echo "Data entered successfully.";
    $stmt->close();
    $conn->close();
    redirect_to("./user_page.php");
    
  }
}

