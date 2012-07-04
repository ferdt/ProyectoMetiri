<?php session_start();
if (isset($_SESSION['uname'])) {
$uname=$_SESSION['uname'];
} else {
echo("Acces denied");
exit;
}
?>