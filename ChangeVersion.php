<?php
session_start();

if(!isset($_SESSION['mobile'])){
   header('Location: PageNotFound.php');
   exit;
}
else{
  $_SESSION['mobile'] = !$_SESSION['mobile'];
  header('Location: ' . $_SESSION['lastPlace']);
  exit;
}
?>
