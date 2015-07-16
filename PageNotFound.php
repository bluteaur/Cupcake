<!doctype html>
<html>
  <head>
    <title>Cupcake Messaging Login</title>
    <link rel="stylesheet" type="text/css" href="cupcake.css">
    <meta name="Cupcake Messaging" content="Your messaging site!">
    <meta name="Cupcake Messaging" content="We don't sell your information. You have control.">
  </head>
  <body>
    <div id="LoginForm">I think you don't belong here so.. Let me MEOW at you :3 
    <a href="index.php">Click Here To Escape!</a>
    <?php
      echo '<br />';
      for($i = 0; $i < 100; $i++){
        echo '<span id="invalid">MENOW! </span>';
        if($i+1 % 10 == 0) echo '<br />';
      }
    ?>
    </div>
  </body>
</html>
