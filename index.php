<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>WebFont.load({ google: {families: ['Open Sans']} });</script>
    <link href="css/index.css" rel="stylesheet">
  </head>
  <body>
    <h2>PHP User Registration & Login</h2>
    <div>Existing users, please login:</div><br>
    <form method="post" action="php/login.php">
      <div>username:</div>
      <input type="text" name="username">
      <div>password:</div>
      <input type="password" name="password"><br>
      <input type="submit" value="Log in">
    </form><br>
    <a target="_self" href="php/signup.php"><div>Need to register?</div></a>
  </body>
</html>
