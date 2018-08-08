<?php

require 'redirect.php';

session_start();

unset($_SESSION['username']);
unset($_SESSION['photo']);
unset($_SESSION['id']);
unset($_SESSION['user_info']);

echo "Logging you out...";
redirect_to("../index.php");

?>
