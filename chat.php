<?php
session_start();
if($_SESSION['login'] == false || !isset($_SESSION['login']) || $_SESSION['bot'] || !isset($_POST['id'])){
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
       echo '<link rel="stylesheet" type="text/css" href="chatMobile.css">';
      else
       echo '<link rel="stylesheet" type="text/css" href="chat.css">';
    ?>
    <meta name="Cupcake Messaging" content="Your messaging site!">
    <meta name="Cupcake Messaging" content="We don't sell your information. You have control.">
  </head>
  <body>
    <div id="LoginForm">
       To be made.<br />
       <?php
         if($_SESSION['mobile']){
            echo '<div id=chatbox><div id=innerChat'. $_POST['id'] .'>NoChatYet</div></div>';
         }
       ?>
       Received id: <?php echo $_POST['id']; ?><br />
       <a href="main.php">Click here to go back!</a><br />
    </div>
  </body>
</html>
