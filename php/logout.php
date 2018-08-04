<?php

require 'redirect.php';

session_start();

unset($_SESSION['username']);
unset($_SESSION['photo']);

echo "Logging you out...";
redirect_to("../index.php");

 ?>
