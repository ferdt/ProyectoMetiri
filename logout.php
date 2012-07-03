<?php
unset($_SESSION['uid']);
unset($_SESSION['pwd']);
$_SESSION = array();
session_destroy();
?>