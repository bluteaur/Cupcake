<?php
  /*start session here */

  /* code that'll check $_POST['signup'] 
                  add information to database (username + password)
                  check if everything is valid
                        if not then print error message 
                        else set session['signup'] = true
  */

?>

<?php
  /* code that'll check $_POST['login'] === true || $_SESSION['signup'] === true
                  set $_SESSION['login'] = true
                  set $_SESSION['username'] = $_POST['username']
  */

?>

<?php
  /*code that'll check $_SESSION['login'] === true 
                  if true, redirect to main.php and exit
  */
?>

<!doctype html>
<html>
  <head>
    <title>Cupcake Messaging Login</title>
  </head>
  <body>
    <?php
      /*code that'll display the login/signup stuff
              FORM:
                    action = index.php
                    $_POST['username']
                    $_POST['password']
    FROM BUTTONS    $_POST['login']   or  $_POST['signup']
      */
    ?>
  </body>
</html>

<!-- java script to check validations goes here -->
