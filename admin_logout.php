<?php
session_start();
$_SESSION = array();
setcookie('Pseudo', '', time() - 3600);
setcookie('Email', '', time() - 3600);

session_destroy();

header("Location: index.php");



 ?>
