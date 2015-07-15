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
  $error = false;
  if(isset($_POST['signup'])){
      //setting up database access
    try{
      if($_SESSION['signup'] === true)
        throw new Exception('Already signed up, try again later.');
      $con = new PDO('mysql:host=localhost;dbname=bluteaur_CUPCAKE', 'CUPCAKE', '1234567890');
        //error handeling mode to exception handeling
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //getting all users with that username
      $sql = $con->prepare("SELECT * FROM access WHERE username = :username");
        //checking for invalid characters. Allowed: (letters, digits, dashes)
      $tempName = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['username']);
        //if a character got replaced than we'll throw an exception
      if($tempName !== $_POST['username'])
        throw new Exception('Invalid Username.');
      $sql->bindParam(':username', $tempName);
    	$sql->execute();
    	$values= $sql->fetchAll();
    	  //if we found a user with that username then throw exception
    	if($value['username'][0] === $_POST['username'])
    	  throw new Exception('Username Taken.');
    	    //here the user is safe to register
    	    //hashing + salting password
    	$password = '%^&*!!!Hi' . $_POST['password'] . 'Are you a wizard?';
    	$password = hash('md5', $password);
    	$admin = 0; //not an admin
    	  //adding user to access table
      $sql = $con->prepare("INSERT INTO access VALUES (:username, :password, :admin)");
      $sql->bindParam(':username', $_POST['username']);
      $sql->bindParam(':password', $password);
      $sql->bindParam(':admin', $admin);
    	$sql->execute();
    	$_SESSION['signup'] = true; //To know that we signed up
    	$_SESSION['login'] = false; //not logged in yet
    }
    catch(Exception $e) {
      $error = true;
      $errorMessage = $e->getMessage();
    }
  }

?>

<?php
  /* code that'll check isset($_POST['login']) || isset($_SESSION['signup'])
                  set $_SESSION['login'] = true
                  set $_SESSION['username'] = $_POST['username']
  */
  if(($_SESSION['signup'] === true || isset($_POST['login'])) && !$error){
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
