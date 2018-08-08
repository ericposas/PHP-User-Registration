<?php

require 'redirect.php';

session_start();

unset($_SESSION['username']);
unset($_SESSION['photo']);
unset($_SESSION['id']);
unset($_SESSION['user_info']);

echo "
  <script src='https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js'></script>
    <script>WebFont.load({ google: {families: ['Open Sans']} });</script>
  <style>
    html{
      font-family: 'Open Sans', sans-serif;
    }
  </style>
";
echo "Logging you out...";
redirect_to("../index.php");

?>