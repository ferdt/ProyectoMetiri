<?php include('sessioncontrol.php'); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/basic1.css" />
</head>
<body>

<?php
include_once ('DBConfig.php');
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
echo '<table width=550 border=0><td>';
//User photo
if (file_exists("userimg/".$id.".jpg")){
	echo "<img src=userimg/".$id.".jpg width=150 height=150 color=White border=5>";
}
else {
	echo "<img src=userimg/default.jpg width=150 height=150>";
}
echo '</td>';
echo '<td>Vehicles</td>';
echo '<table>';
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
	$query  = "SELECT laps.sessionID,tracks.name,laps.time,vehicles.name, laps.timestamp
	FROM (laps join tracks on laps.trackID = tracks.id)
	join vehicles on laps.carID = vehicles.id
	WHERE laps.userID = '$id' AND laps.trackID = '$trackID'
	ORDER BY `laps`.`time` ASC
	LIMIT 0 , 5";
	$result = mysqli_query($ms,$query);
	
	if (mysqli_num_rows($result) > 0) {
		echo "<table class='ListTable'>";
		echo "<tr>";
		echo "<th>Time</th>
			<th>Car</th>
			<th>TimeStamp</th>";
		echo "</tr>";
			
		while($row = mysqli_fetch_row($result)) {
			//echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
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