<?php include('sessioncontrol.php'); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/basic1.css" />
</head>
<body>

<?php
include_once ('dbconfig.php');
include ('header.php');
echo "<div id='page-wrap'>";
$id = $_GET['id'];
$uid=$_SESSION['uid'];

$query = "DELETE FROM `follow` 
		WHERE (`er`='$uid' AND `ed`='$id')
		";
 $r = mysqli_query($ms, $query);
//echo $query;
$query = "SELECT DISTINCT users.name FROM users
		WHERE userid='$id'";
$result = mysqli_query($ms, $query);
$user = mysqli_fetch_row($result);

echo "<h1>You are now not following ".$user[0].".</h1><br>";
echo "<a><button class='normal' onClick='history.go(-1);return true;'>Back</button></a><br>";


?>
</div>
</body>
</html>