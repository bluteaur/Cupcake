<?php
  /*start session here */
  session_start();
  
  /* code that'll check isset($_POST['signup'])
                  add information to database (username + password)
                  check if everything is valid
                        if not then print error message 
                        else set session['signup'] = true
  */
  $UserNameMatch = true;
  $PasswordMatch = true;
  if(isset($_POST['signup'])){
    //check data and set UserNameMatch and PasswordMatch
    //put info in database
    //check database errors
    $_SESSION['signup'] = true;
  }

?>

<?php
  /* code that'll check isset($_POST['login']) || isset($_SESSION['signup'])
                  set $_SESSION['login'] = true
                  set $_SESSION['username'] = $_POST['username']
  */
  if($_SESSION['signup'] === true || isset($_POST['login'])){
    //get username + password from database
    //match username + password to an account and set variables below
    $UserNameMatch = false;
    $PasswordMatch = false;
    if($match){
      $_SESSION['login'] = true;
        //look in database and see if user is an admin
      $_SESSION['admin'] = false; //admin creation
        //here we will gather any additionnal information needed from database
      $_SESSION['username'] = $_POST['username'];
    } else {
      $_SESSION['login'] = false;
      $_SESSION['admin'] = false;
    }
  }

?>

<?php
  /*code that'll check $_SESSION['login'] === true 
                  if true, redirect to main.php and exit
  */
  
  if($_SESSION['login'] === true){
    header('Location: main.php');
    exit;
  }
  
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
  echo '<div>';
  echo '<form action="index.php" method="post">';
if(!$UserNameMatch)
  echo '<span style = "font-color:red">';
  echo 'Username: ';
if(!$UserNameMatch)
  echo '*<\span>';
  echo '<input type="text" name="username"> <br>';
if(!$PasswordMatch)
  echo '<span style = "font-color:red">';
  echo 'Password: ';
if(!$PasswordMatch)
  echo '*<\span>';
  echo '<input type="password" name="password" autocomplete="off"> <br>';
  echo '<input type="submit" name="signup" value="Signup">';
  echo '<input type="submit" name="login" value="Login">';
  echo '</form>';
  echo '</div>';

    ?>
  </body>
</html>

<!-- java script to check validations goes here -->
