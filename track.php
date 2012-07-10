<html>
<head>
<title>Proyecto Metiri: Track</title>
<link rel="stylesheet" type="text/css" href="style/basic1.css" />
</head>
<body>

<?php
include ("DBConfig.php");
include ("Header.php");
echo "<div id='page-wrap'>";
$ID = $_GET['id'];
$query  = "SELECT * FROM tracks WHERE ID = '$ID'";
$result = mysqli_query($ms,$query);
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_row($result);
	echo "<h1>".$row[1]."</h1>";
	echo "<P>";
}
	?><iframe width="650" height="350" frameborder="0" scrolling="yes" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;hq=&amp;ll=40.615721,-3.588406&amp;spn=0.023488,0.026865&amp;t=h&amp;z=15&amp;output=embed"></iframe><br /><?php
	//Query laps on that track
	$query  = "SELECT laps.sessionID,users.name,users.userID,min(laps.TIME),vehicles.name,vehicles.class, laps.timestamp
	FROM (laps join users on laps.userID = users.userid
			join vehicles on laps.carID = vehicles.id)
	WHERE laps.trackID = '$ID'
	GROUP BY `users`.`name`
	ORDER BY min(laps.TIME) ASC
	";
	$result = mysqli_query($ms,$query);
	echo "<h2>Lap times</h2>";
	
	if (mysqli_num_rows($result) > 0) {
		echo "<table class='ListTable'>";
		echo "<tr>";
		echo "<th>Time</th>
			<th>User</th>
			<th>Car</th>
			<th>Class</th>
			<th>Date</th>";
		echo "</tr>";
			
		while($row = mysqli_fetch_row($result)) {
			echo "<td>".$row[3]."</td>";
			echo "<td><a href="."user.php"."?id=".$row[2].">".$row[1]."</a></td>";
			echo "<td>".$row[4]."</td>";
			echo "<td>".$row[5]."</td>";
			echo "<td>".$row[6]."</td>";
			//echo "<td><a href="."user.php"."?id=".$row[0].">View</a>";
			echo "</tr>";
		}
		echo "</table>";
}
echo "</P>";
?>
</div>
</body>
</html>