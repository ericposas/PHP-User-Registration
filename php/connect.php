<?php

$server = "localhost";
$username = "root";
$password = "mysql";

$conn = new mysqli($server, $username, $password);
if($conn->connect_error){
  die("Connection failed: ".$conn->connect_error);
}

$db = mysqli_select_db($conn, "registration_site");
if(!$db){
  die("Can't use database: ".mysqli_error());
}

 ?>
