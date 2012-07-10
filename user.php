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
echo "<table width=550 border=0><td>";
//User photo
if (file_exists("userimg/".$id.".jpg")){
	echo "<img src=userimg/".$id.".jpg width=150 height=150 border=1>";
}
else {
	echo "<img src=userimg/default.jpg width=150 height=150 border=1>";
}
echo "</td><td  valign='top'>";
//User vehicles
echo "<table>";
echo "<h2>Vehicles</h2>";
$query  = "SELECT vehicles.ID,series.make,series.model,series.version
FROM (vehicles join series on vehicles.chassis = series.id)
WHERE vehicles.userID = '$id'
";
$cars = mysqli_query($ms,$query);
if (mysqli_num_rows($cars) > 0) {
	while($row = mysqli_fetch_row($cars)) {
		//echo "<td>".$row[0]."</td>";
		echo "<td>".$row[1]."</td>";
		echo "<td>".$row[2]."</td>";
		echo "<td>".$row[3]."</td>";
		echo "</tr>";
	}
}
//Achievements
echo "<tr><td  valign='top'>";
echo "<h2>Achievements</h2>";


echo "</td></tr>";
echo "</table>";
echo "</td>";

echo "</table>";

//Follow - Unfollow
if ($id != $_SESSION['uid']) {
$uid =$_SESSION['uid'];
$query  = "SELECT count(*)
FROM follow
WHERE follow.ed = '$id' AND follow.er = '$uid'
";
$result = mysqli_query($ms,$query);
$result = mysqli_fetch_row($result);

if ($result[0]<=0) {
	echo "<form>";
	echo "<a href='follow.php?id=".$id."'><button class='normal'>Follow</button></a><br>";
	echo "</form>";
	}
else {
	echo "<form>";
	echo "<a href='unfollow.php?id=".$id."'><button class='normal'>Unfollow</button></a><br>";
	echo "</form>";
	}
}

//Following
$query  = "SELECT DISTINCT count(users.name), follow.ed
FROM (follow join users ON follow.ed = users.userid)
WHERE follow.er = '$id'
ORDER BY `users`.`Name` ASC
LIMIT 0 , 10";
$result = mysqli_query($ms,$query);
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_row($result)) {
		echo "<table  valign='center'><tr><td><h2>Following: </h2></td>";
		echo "<td><a href="."following.php"."?id=".$id.">".$row[0]."</a></td>";
		echo "</tr>";
	}
} else {
		echo "Nobody";
}
echo "</table>";
echo "</td><td  valign='top'>";
//Followers
$query  = "SELECT DISTINCT count(users.name), follow.er
FROM (follow join users ON follow.er = users.userid)
WHERE follow.ed = '$id'
ORDER BY `users`.`Name` ASC
LIMIT 0 , 10";
$result = mysqli_query($ms,$query);

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_row($result)) {
		echo "<table><tr><td><h2>Followers: </h2></td>";
		echo "<td><a href="."followers.php"."?id=".$id.">".$row[0]."</a></td>";
		echo "</tr>";
	}
} else {
		echo "Nobody";
}

//echo "</td></tr>";
echo "</table>";
//Query tracks
$query  = "SELECT tracks.ID,tracks.name
FROM (tracks join laps on laps.trackID = tracks.id)
WHERE laps.userID = '$id'
GROUP BY  `tracks`.`Name`
ORDER BY `tracks`.`Name` ASC";
$tracks = mysqli_query($ms,$query);

if (mysqli_num_rows($tracks) > 0) {
	while($row = mysqli_fetch_row($tracks)) {
	$trackID = $row[0];
	$track = $row[1];
	echo "<h2><a href="."track.php?id=".$trackID.">".$track."</a></h2>";
	//Query laps on that track
	$query  = "SELECT laps.sessionID,tracks.name,laps.time,vehicles.name,vehicles.class, laps.timestamp
	FROM (laps join tracks on laps.trackID = tracks.id)
	join vehicles on laps.carID = vehicles.id
	WHERE laps.userID = '$id' AND laps.trackID = '$trackID'
	ORDER BY `laps`.`time` ASC
	LIMIT 0 , 5";
	// $query  = "SELECT laps.time, vehicles.class, classes.name
	// FROM (laps, vehicles, join classes on vehicles.class=class.id)
	// WHERE laps.userID = '$id' AND laps.trackID = '$trackID'
	// ORDER BY `laps`.`time` ASC
	// LIMIT 0 , 5";
	$result = mysqli_query($ms,$query);
	
	if (mysqli_num_rows($result) > 0) {
		echo "<table class='ListTable'>";
		echo "<tr>";
		echo "<th>Time</th>
			<th>Car</th>
			<th>Class</th>
			<th>TimeStamp</th>";
		echo "</tr>";
			
		while($row = mysqli_fetch_row($result)) {
			//echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
			echo "<td>".$row[5]."</td>";
			//echo "<td><a href="."user.php"."?id=".$row[0].">View</a>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
echo "</P>";
	
}
else {
	echo "No track found";
}
?>
</div>
</body>
</html>