<?php
  session_start();
$array = array(null);
if($_SESSION['login'] == false || !isset($_SESSION['login']) || $_SESSION['bot']){
 echo json_encode($array);
 exit;
}
if(!is_numeric($_GET['row']) || !is_numeric($_GET['id']) || !isset($_GET['row']) || !isset($_GET['id'])){
  echo json_encode($array);
  exit;
}
      $con = new PDO('mysql:host=localhost;dbname=bluteaur_CUPCAKE', 'bluteaur_CUPCAKE', 'Sup3rS3cr3tPassword');
        //error handeling mode to exception handeling
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //getting all users with that username
      $sql = $con->prepare("SELECT message FROM chats WHERE id = :id and friend = :friend LIMIT :row , 1");
      $sql->bindParam(':id', $_SESSION['id']);
      $sql->bindParam(':friend', $_GET['id']);
      $sql->bindParam(':row', $_GET['row']);
      $sql->execute();
      $value= $sql->fetchAll();
      $array[0] = htmlentities($value[0][0]);
      echo json_encode($array);
      exit;
?>
