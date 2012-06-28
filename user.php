<html>
<head>
<link rel="stylesheet" type="text/css" href="style/basic1.css" />
</head>
<body>

<?php
include ("DBConfig.php");
include ("Header.php");
echo "<div id='page-wrap'>";
$id = $_GET['id'];
//$id	= 1;
$query  = "SELECT * FROM users WHERE userID = '$id'";
$result = mysqli_query($ms,$query);
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_row($result);
	echo "<h1>".$row[1]."</h1>";
	echo "<P>";
}
//Query tracks
$query  = "SELECT tracks.ID,tracks.name
FROM (tracks join laps on laps.trackID = tracks.id)
WHERE laps.userID = '$id'
GROUP BY  `tracks`.`Name`
ORDER BY `tracks`.`Name` ASC";
$tracks = mysqli_query($ms,$query);

if (mysqli_num_rows($tracks) > 0) {
	while($row = mysqli_fetch_row($tracks)) {
	$track0 = $row[1];
	echo "<h2>".$row[1]."</h2>";
	//Query laps on that track
	$query  = "SELECT laps.sessionID,tracks.name,laps.time,vehicles.name
	FROM (laps join tracks on laps.trackID = tracks.id)
	join vehicles on laps.carID = vehicles.id
	WHERE laps.userID = '$id' AND tracks.name = '$track0'
	ORDER BY `tracks`.`Name` ASC";
	$result = mysqli_query($ms,$query);
	
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_row($result);
		$track0 = $row[1];
		echo "<table class='ListTable'>";
		echo "<tr>";
		echo "<th>Time</th><th>Car</th>";
		echo "</tr>";
			
		while($row = mysqli_fetch_row($result) AND $row[1] = $track0) {
			//echo "<td>".$row[0]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
			//echo "<td><a href="."user.php"."?id=".$row[0].">View</a>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
echo "</P>";
	
}
else {
	echo "No user found!";
}

		
?>
</div>
</body>

</html>