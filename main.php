<?php
session_start();
if($_SESSION['login'] == false || !isset($_SESSION['login']) || $_SESSION['bot']){
 header('Location: PageNotFound.php');
 exit;
}
?>
<!doctype html>
<html>
  <head>
    <title>Cupcake Messaging Login</title>
    <link rel="stylesheet" type="text/css" href="cupcake.css">
    <meta name="Cupcake Messaging" content="Your messaging site!">
    <meta name="Cupcake Messaging" content="We don't sell your information. You have control.">
  </head>
  <body>
    <div id="LoginForm">Logout:
    <a href="logout.php">Click Here!</a>
    </div>
  </body>
</html>
