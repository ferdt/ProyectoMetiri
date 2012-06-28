<html>
<head>
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
	
	//Query laps on that track
	$query  = "SELECT laps.sessionID,users.username,laps.time,vehicles.name
	FROM (laps join users on laps.userID = users.userid)
	join vehicles on laps.carID = vehicles.id
	WHERE laps.trackID = '$ID'
	ORDER BY `laps`.`Time` ASC";
	$result = mysqli_query($ms,$query);
	
	if (mysqli_num_rows($result) > 0) {
		echo "<table class='ListTable'>";
		echo "<tr>";
		echo "<th>User</th>
			<th>Time</th>
			<th>Car</th>";
		echo "</tr>";
			
		while($row = mysqli_fetch_row($result)) {
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
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