<?php

session_start();

require 'redirect.php';
require 'connect.php';

$filetypes = array(
  'image/jpg',
  'image/jpeg',
  'image/png',
  'image/gif'
);

if(!empty($_FILES['file'])){
  $path = "../Users/".$_SESSION['username']."/profile_photo"."/";
  $path = $path.basename($_FILES['file']['name']);
  check_against_file_types();
}

function check_against_file_types(){
  global $filetypes;
  if(in_array($_FILES['file']['type'], $filetypes)){
    continue_with_upload();
  }else{
    echo "Unsupported file type";
    redirect_to("user_page.php");
  }
}

function continue_with_upload(){
  global $path;
  if(move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
    echo "The file ".basename($_FILES['file']['name'])." has been uploaded";
    insert_photo_name_into_db();
  }else{
    echo "There was an error uploading the file, please try again.";
  }
}

function insert_photo_name_into_db(){
  global $conn;
  $stmt = $conn->prepare("UPDATE `users` SET `photo`=? WHERE `username`=?");
  $stmt->bind_param("ss", $_FILES['file']['name'], $_SESSION['username']);
  if($stmt->execute()){
    redirect_to("user_page.php");
  }
  $stmt->close();
  $conn->close();
}

?>
