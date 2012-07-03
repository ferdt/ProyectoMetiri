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
session_start();

$uname = $_POST['name'];
$pass = $_POST['pwd'];
 
echo $uname;
echo "<br>";
echo $pass;
echo "<br>";

$query = "SELECT count(*) FROM users WHERE(
username='".$uname."' AND  password='".$pass."')";
 
//$query = mysql_query($sql);
echo $query;
echo "<br>";
$result = mysqli_query($ms,$query);
$result = mysqli_fetch_row($result);
echo "<br>".$result."<br>";
if($result[0]>0)	{
    echo "Successful Login!";
    $_SESSION['uid'] = $uname;
	$_SESSION['pwd'] = $pass;
    echo "<br />Welcome ".$_SESSION['uid']."!";
    echo "<br /><a href='signupform.php'>SignUp</a>";
    echo "<br /><a href='signinform.php'>SignIn</a>";
    echo "<br /><a href='logout.php'>LogOut</a>";
} else {
	echo "Login Failed";
    echo "<br /><a href='signupform.php'>SignUp</a>";
    echo "<br /><a href='signinform.php'>SignIn</a>";
}
header('Location: home.php')
?>
</div>
</body>
</html> 