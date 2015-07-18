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
    <title>Cupcake Messaging</title>
    <?php
    if($_SESSION['mobile'])
       echo '<link rel="stylesheet" type="text/css" href="cupcakeMobile.css">';
      else
       echo '<link rel="stylesheet" type="text/css" href="cupcake.css">';
    ?>
    <meta name="Cupcake Messaging" content="Your messaging site!">
    <meta name="Cupcake Messaging" content="We don't sell your information. You have control.">
  </head>
  <body>
    <div id="LoginForm">Logout:
    <a href="logout.php">Click Here!</a>
    </div>
    <?php
    $_SESSION['lastPlace'] = 'main.php';
    if($_SESSION['mobile'])
      $type = "Mobile";
    else $type = "Desktop";
    echo '<div id="request"><a href="ChangeVersion.php">Request ' . $type . ' Version.</a></div>';
    ?>
  </body>
</html>
