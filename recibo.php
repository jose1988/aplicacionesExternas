<?php
session_start();
  require_once('nusoap.php'); 

echo '<pre>';
print_r($_SESSION["Analista"]);

?>