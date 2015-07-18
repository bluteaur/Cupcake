<?php
session_start();

if(!isset($_SESSION['mobile']) || !isset($_SESSION['lastPlace'])){
   header('Location: PageNotFound.php');
   exit;
}
else{
  $_SESSION['mobile'] = !$_SESSION['mobile'];
  header('Location: ' . $_SESSION['lastPlace']);
  exit;
}
?>
