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
      $con = new PDO('mysql:host=localhost;dbname=bluteaur_CUPCAKE', 'bluteaur_CUPCAKE', 'Sup3rS3cr3tPassword');
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
    	$value= $sql->fetchAll();
    	  //if we found a user with that username then throw exception
    	if($value[0][1] === $_POST['username'])
    	  throw new Exception('Username Taken.');
    	    //here the user is safe to register
    	    //hashing + salting password
    	$password = '%^&*!!!Hi' . $_POST['password'] . 'Are you a wizard?';
    	$password = hash('md5', $password);
    	$admin = 0; //not an admin
    	  //adding user to access table
      $sql = $con->prepare("INSERT INTO access VALUES (null, :username, :password, :admin)");
      $sql->bindParam(':username', $_POST['username']);
      $sql->bindParam(':password', $password);
      $sql->bindParam(':admin', $admin);
    	$sql->execute();
    	$_SESSION['signup'] = true; //To know that we signed up
      $_SESSION['signup2'] = true;
    	$_SESSION['login'] = false; //not logged in yet
    	$con = null;
    }
    catch(Exception $e) {
      $error = true;
      $errorMessage = $e->getMessage();
      $con = null;
    }
  }
?>

<?php
  /* code that'll check isset($_POST['login']) || isset($_SESSION['signup'])
                  set $_SESSION['login'] = true
                  set $_SESSION['username'] = $_POST['username']
  */
  if(($_SESSION['signup2'] === true || isset($_POST['login'])) && !$error){
    $_SESSION['login'] = false; $_SESSION['signup2'] = false;
    try{
      if($_SESSION['attemps'] > 20)
        throw new Exception('Too many attemps, try again later.');
      $con = new PDO('mysql:host=localhost;dbname=bluteaur_CUPCAKE', 'bluteaur_CUPCAKE', 'Sup3rS3cr3tPassword');
        //error handeling mode to exception handeling
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = $con->prepare("SELECT * FROM access WHERE username = :username");
        //checking for invalid characters. Allowed: (letters, digits, dashes)
      $tempName = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['username']);
        //if a character got replaced than we'll throw an exception
      if($tempName !== $_POST['username']){
         $UserNameMatch = false;
        throw new Exception('Invalid Username.');
      }
      $sql->bindParam(':username', $tempName);
    	$sql->execute();
    	$value= $sql->fetchAll();
      if($value == null){
        throw new Exception('Something went wrong.');
      }
    	$password = '%^&*!!!Hi' . $_POST['password'] . 'Are you a wizard?';
    	$password = hash('md5', $password);
    	if($password != $value[0][2] || $_POST['username'] != $value[0][1]){
    	  $UserNameMatch = false;
          $PasswordMatch = false;
          throw new Exception('Invalid Login.');
    	}
      $UserNameMatch = true;
      $PasswordMatch = true;
      $_SESSION['login'] = true;
        //look in database and see if user is an admin
      if($value[0][3] === 1)
        $_SESSION['admin'] = true;
      else
        $_SESSION['admin'] = false; 
        //here we will gather any additionnal information needed from database
      $_SESSION['username'] = $value[0][1];
      $con = null;
    }
    catch(Exception $e) {
      $_SESSION['login'] = false;
      $_SESSION['admin'] = false;
      $error = true;
      $errorMessage = $e->getMessage();
      $con = null;
      if(!isset($_SESSION['attempts']))
        $_SESSION['attempts'] = 0;
      if($_SESSION['attemps'] <= 20)
        $_SESSION['attemps']++;
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
    <link rel="stylesheet" type="text/css" href="cupcake.css">
    <meta name="Cupcake Messaging" content="Your messaging site!">
    <meta name="Cupcake Messaging" content="We don't sell your information. You have control.">
    <!-- java script to check validations goes here -->
    <script>
      function validateForm() {
        var x = document.forms["validate"]["username"].value;
        var y = document.forms["validate"]["password"].value;
        var x2 = x.length;
        var y2 = y.length;
        if (x == null || x == "" || y == null || y == "") {
          alert("Username and password must be filled out");
          return false;
        }
        if(x2 < 8 || y2 < 6){
          alert("Username or password too short.");
          return false;
        }
        var temp = x.replace(/ |\n|\r|\t|\s/, "");
        var temp = temp.replace(/[^a-zA-Z0-9\-]/, "")
        if(temp.localeCompare(x) != 0){
          alert("Username has invalid characters, use a-z A-Z 0-9 or '-'.");
          return false;
        }
        if(y.search(/[A-Z]/) == -1){
          alert("Password must contain a capital letter.");
          return false;
        }
        if(y.search(/[0-9]/) == -1){
          alert("Password must contain a digit.");
          return false;
        }
        if(y.search(/[a-z]/) == -1){
          alert("Password must contain a lowercase letter.");
          return false;
        }
        return true;
      }
    </script>
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
  echo '<div id="LoginForm">';
  if($error === true)
     echo $errorMessage;
  echo '<form action="index.php" method="post" name="validate">';
if(!$UserNameMatch)
  echo '<span id="invalid">';
  echo 'Username: ';
if(!$UserNameMatch)
  echo '*</span>';
  echo '<input type="text" name="username" id="input"> <br>';
if(!$PasswordMatch)
  echo '<span id="invalid">';
  echo 'Password: ';
if(!$PasswordMatch)
  echo '*</span>';
  echo '<input type="password" name="password" autocomplete="off" id="input"> <br>';
  echo '<input type="submit" name="login" value="Login">';
  echo '<input type="submit" name="signup" value="Signup" onclick="return validateForm()">';
  echo '</form>';
  echo '</div>';
    ?>
  </body>
</html>
