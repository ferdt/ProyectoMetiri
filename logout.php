<?php
session_start();
unset($_SESSION['uid']);
unset($_SESSION['pwd']);
$_SESSION = array();
session_destroy();
header('Location: inicio.php');
?>
