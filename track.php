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
	echo "<iframe width='350' height='350' frameborder='0' scrolling'no' marginheight='0' marginwidth='0'
	src'https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;
	q=Circuito+del+Jarama,+San+Sebasti%C3%A1n+de+los+Reyes,+Spain&amp;aq=0&amp;
	oq=circu&amp;sll=40.416691,-3.700345&amp;sspn=0.612695,0.970917&amp;t=h&amp;ie=UTF8&amp;
	hq=Circuito+del+Jarama,+San+Sebasti%C3%A1n+de+los+Reyes,+Spain&amp;
	ll=40.615721,-3.588406&amp;spn=0.011357,0.014575&amp;output=embed'></iframe><br />
	<small><a href='https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Circuito+del+Jarama,
	+San+Sebasti%C3%A1n+de+los+Reyes,+Spain&amp;aq=0&amp;oq=circu&amp;sll=40.416691,-3.700345&amp;
	sspn=0.612695,0.970917&amp;t=h&amp;ie=UTF8&amp;hq=Circuito+del+Jarama,+San+Sebasti%C3%A1n+de+los+Reyes,+Spain&amp;
	ll=40.615721,-3.588406&amp;spn=0.011357,0.014575' style='color:#0000FF;text-align:left'>View Larger Map</a></small>";
	//Query laps on that track
	$query  = "SELECT laps.sessionID,users.username,users.userID,min(laps.TIME),vehicles.name, laps.timestamp
	FROM (laps join users on laps.userID = users.userid)
	join vehicles on laps.carID = vehicles.id
	WHERE laps.trackID = '$ID'
	GROUP BY `username`
	ORDER BY `laps`.`Time` ASC
	";

	//GROUP BY userid
	$result = mysqli_query($ms,$query);
	echo "<h2>Lap times</h2>";
	
	if (mysqli_num_rows($result) > 0) {
		echo "<table class='ListTable'>";
		echo "<tr>";
		echo "<th>Time</th>
			<th>User</th>
			<th>Car</th>
			<th>Date</th>";
		echo "</tr>";
			
		while($row = mysqli_fetch_row($result)) {
			echo "<td>".$row[3]."</td>";
			echo "<td><a href="."user.php"."?id=".$row[2].">".$row[1]."</a></td>";
			echo "<td>".$row[4]."</td>";
			echo "<td>".$row[5]."</td>";
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