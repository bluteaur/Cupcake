<?php
  session_start();
  if($_SESSION['login'] == false || !isset($_SESSION['login']) || $_SESSION['bot']){
    header('Location: PageNotFound.php');
    exit;
  }
  $_SESSION['mobile'] = null;
  $_SESSION['login'] = false;
  $_SESSION['username'] = null;
  $_SESSION['admin'] = false;
  $_SESSION['attempts'] = 0;
  header('Location: index.php');
?>
