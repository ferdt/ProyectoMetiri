<?php
include_once ('dbconfig.php');
//session_start();
$uid = isset($_POST['uid']) ? $_POST['uid'] : $_SESSION['uid'];
$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : $_SESSION['pwd'];

echo $uid."<br>";
echo $pwd."<br>";


if (isset($_POST['uid'])) {
$uid = $_POST['uid'];
} else {
$uid = $_SESSION['uid'];
}
if (isset($_POST['pwd'])) {
$pwd = $_POST['pwd'];
} else {
$pwd = $_SESSION['pwd'];
}



if(!isset($uid)) {
?>
<html>
<head>
<title> Please Log In for Access </title>
</head>
<body>
<div id='page-wrap'>
<h1> Login Required </h1>
<p>You must log in to access this area of the site. If you are
not a registered user, <a href="signup.php">click here</a>
to sign up for instant access!</p>
<p><form method="post" action="<?=$_SERVER['PHP_SELF']?>">
User ID: <input type="text" name="uid" size="8" /><br />
Password: <input type="password" name="pwd" SIZE="8" /><br />
<button class="normal" type="submit">Log in<button/>
</form></p>
</div>
</body>
</html>
<?php
exit;
}

$_SESSION['uid'] = $uid;
$_SESSION['pwd'] = $pwd;

//echo mysql(password('pwd'));
echo sha1('pwd')."<br>";

//dbConnect('metiri');
$query = "SELECT * FROM users
WHERE `username` = '$uid' AND `password` = password('$pwd')";
// $query = "SELECT * FROM `users` WHERE
// username = '$uid' AND `password` = '$pwd'";
echo $query;
$result = mysqli_query($ms, $query);
if (!$result) {
echo ('A database error occurred while checking your '.
'login details.\\nIfhis error persists, please '.
'contact you@example.com.');
}

//echo "<br>".$result."<br>";

if (mysqli_num_rows($result) == 0){
exit;
echo ("La cagamos, Luis");
unset($_SESSION['uid']);
unset($_SESSION['pwd']);
?>
<html>
<head>
<title> Access Denied </title>
</head>
<body>
<div id='page-wrap'>
<h1> Access Denied </h1>
<p>Your user ID or password is incorrect, or you are not a
registered user on this site. To try logging in again, click
<a href="<?=$_SERVER['PHP_SELF']?>">here</a>. To register for instant
access, click <a href="signup.php">here</a>.</p>
</div>
</body>
</html>
<?php
exit;
}
?>