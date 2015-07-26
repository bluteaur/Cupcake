<?php
message, id
  session_start();
$array = array(null);
if($_SESSION['login'] == false || !isset($_SESSION['login']) || $_SESSION['bot'])
 exit;
if(!is_numeric($_POST['id']) || !isset($_POST['id']) || !isset($_POST['message']))
  exit;
      $con = new PDO('mysql:host=localhost;dbname=bluteaur_CUPCAKE', 'bluteaur_CUPCAKE', 'Sup3rS3cr3tPassword');
        //error handeling mode to exception handeling
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //getting all users with that username
      $sql = $con->prepare("INSERT INTO chats VALUES(:id, :friend, :message)");
      $sql->bindParam(':id', $_SESSION['id']);
      $sql->bindParam(':friend', $_POST['friend']);
      $sql->bindParam(':message', $_POST['message']);
      $sql->execute();
      exit;
?>
