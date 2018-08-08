<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>WebFont.load({ google: {families: ['Open Sans']} });</script>
    <style>html{ font-family: 'Open Sans', sans-serif; }</style>
  </head>
  <body>
    <h2>Please register for the site</h2>
    <form method="post" action="register_user.php">
      <div>username:</div>
      <input type="text" name="username">
      <div>password:</div>
      <input type="password" name="password"><br>
      <input type="submit" value="Register">
    </form>
    <br>
    <a target="_self" href="../index.php"><div>Back to login page</div></a>
  </body>
</html>
