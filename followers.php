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
//User name
$query  = "SELECT * FROM users WHERE userID = '$id'";
$result = mysqli_query($ms,$query);
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_row($result);
	echo "<h1>".$row[1]."</h1>";
	echo "<br>";
}
//Followers
$query  = "SELECT DISTINCT users.name, follow.er, follow.created
FROM (follow join users ON follow.er = users.userid)
WHERE follow.ed = '$id'
ORDER BY follow.created ASC
LIMIT 0 , 10";
$result = mysqli_query($ms,$query);
echo "<table><tr><td><h2>Following: </h2></td></tr>";
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_row($result)) {
		if (file_exists("userimg/".$row[1].".jpg")){
			$photo=$row[1];
		}
		else {
			$photo='default';
		}
		echo "<tr><td>"."<img src=userimg/".$photo.".jpg width=40 height=40 border=1>"."</td>";
		echo "<td><a href="."user.php"."?id=".$row[1].">".$row[0]."</a></td>";
		echo "</tr>";
	}
} else {
		echo "Nobody";
}
echo "</table>";
echo "</td><td  valign='top'>";
echo "<br>";
echo "<a><button class='normal' onClick='history.go(-1);return true;'>Back</button></a><br>";

?>
</div>
</body>
</html>