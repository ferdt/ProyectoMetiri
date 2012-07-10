<?php session_start(); ?>
<html>
<head>
<table class='header'>
<tr>
<th><a href=inicio.php>Home</a></th>
</tr>
</table>
<title>Proyecto Metiri: Home</title>
<link rel="stylesheet" type="text/css" href="style/home1.css" />
</head>
<body>

<div id="page-wrap">

<?php 
include_once("dbconfig.php"); 
$uname = $_POST['name'];
$pass = $_POST['pass'];
$query = "SELECT * FROM users WHERE(
	name='".$uname."' AND  password=password('".$pass."'))";
//echo $query;
$result = mysqli_query($ms,$query);

if(mysqli_num_rows($result) > 0)	{
	$result = mysqli_fetch_row($result);
    echo "Successful Login!";
    $_SESSION['uid'] = $result[0];
	$_SESSION['uname'] = $result[1];
	$_SESSION['pass'] = $result[2];
    echo "<br />Welcome ".$_SESSION['uid']."!";
	//sleep(10);
	header('Location: home.php');
} else {
	echo "<h1>Login Failed</h1>";
    echo "<br /><a href='inicio.php'>Try again</a>";
    echo "<br /><a href='signup.php'>Sign Up</a>";
}
?>
</div>
</body>
</html> 