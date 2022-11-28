<?php 
  session_start();
  $lenguaje = $_GET['idioma'];
  setcookie("idioma", $lenguaje, time()+ 60*60*24);
  header("Location: mipanel.php")
?>
