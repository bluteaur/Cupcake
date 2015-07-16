<?php
  session_start();
  $_SESSION['login'] = false;
  $_SESSION['username'] = null;
  $_SESSION['admin'] = false;
  $_SESSION['attempts'] = 0;
  header('Location: index.php');
?>
