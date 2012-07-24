<html>
<head>
<title>Proyecto Metiri: Track</title>
<link rel="stylesheet" type="text/css" href="style/basic1.css" />
</head>
<body>
<?php
include ("dbconfig.php");
include ("header.php");
$pos=1;
$i = 1;
echo "<div id='page-wrap'>";
$ID = $_GET['id'];
$query  = "SELECT * FROM tracks WHERE id = '$ID'";
$result = mysqli_query($ms,$query);
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_row($result);
	echo "<h1>".$row[1]."</h1>";
	echo "<P>";
}
	/*?><iframe width="650" height="350" frameborder="0" scrolling="yes" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;hq=&amp;ll=40.615721,-3.588406&amp;spn=0.023488,0.026865&amp;t=h&amp;z=15&amp;output=embed"></iframe><br /><?php*/
	$x=$row[3]/1;
	$y=$row[4]/1;
	echo "<iframe width=\"650\" height=\"350\" frameborder=\"0\" scrolling=\"yes\" marginheight=\"0\" marginwidth=\"0\" src=\"https://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;hq=&amp;ll=".$x.",".$y."&amp;spn=0.023488,0.026865&amp;t=h&amp;z=15&amp;output=embed\"></iframe><br />";
	//Query laps on that track
	$query  = "SELECT laps.sessionID,users.name,users.userID,users.countryid,min(laps.TIME),vehicles.name,vehicles.class, laps.timestamp, laps.maxspeed, laps.gps
	FROM (laps join users on laps.userID = users.userid 
		join vehicles on laps.carID = vehicles.id)
	WHERE laps.trackID = '$ID'
	GROUP BY `users`.`name`
	ORDER BY min(laps.TIME) ASC
	";
	//echo $query;
	$result = mysqli_query($ms,$query);
	echo "<h2>Lap times</h2>";
	if (mysqli_num_rows($result) > 0) {
		echo "<table class='ListTable'>";
		echo "<tr>";
		echo "<th>Pos</th>
			<th>Driver</th>
			<th>Car</th>
			<th>Class</th>
			<th>Time</th>
			<th>Gap</th>
			<th>Max speed</th>
			<th>Date</th>
			<th>GPS</th>";
		echo "</tr>";
		//$time=0.00;
		while($row = mysqli_fetch_row($result)) {
			echo "<td align='right'>".$pos."</td>";
			if (file_exists("img/flags/".$row[3].".gif")){
				echo "<td>"."<img src=img/flags/".$row[3].".gif width=20 height=15 border=1> ";
					}
			else {
				echo "<td>"."<img src=img/flags/00.gif width=20 height=15 border=1> ";
					}
			echo "<a href="."user.php"."?id=".$row[2].">".$row[1]."</a></td>";
			echo "<td>".$row[5]."</td>";
			echo "<td>".$row[6]."</td>";
			echo "<td>".strftime("%M:%S",$row[4])."</td>";
			if ($pos==1) {$gap=0.00;$besttime=$row[4];}
			else {$gap=$row[4]-$besttime;}
			echo "<td> +".strftime("%M:%S",$gap)."</td>";
			echo "<td>".number_format($row[8]*3.6,1)."</td>";
			echo "<td>".date('dS \of F Y',strtotime($row[7]))."</td>";
			echo "<td>"."<img src=icons/GPS".$row[9].".gif width=20 height=20 border=0> ";
			
			++$pos;
			echo "</tr>";
		}
		echo "</table>";
}
echo "</P>";
?>
</div>
</body>
</html>