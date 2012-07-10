<?php include('sessioncontrol.php'); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/basic1.css" />
</head>
<body>

<?php
include_once ('DBConfig.php');
include ('header.php');
?>
<div id='page-wrap'>
<h1>Upload lap time</h1>
<p>A lap time will be added to your laptime list.<br>
<!--Track-->
<?php
$id=$_SESSION['uid'];
if (!isset($_POST['track'])) {
$query = "SELECT * FROM tracks
";
$result = mysqli_query($ms,$query);
echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
echo "<table cellspacing=10 cellpadding=10>
	<tr>
	<td>Select the track</td>";
echo "<td><select name='track'>";
while ($row = mysqli_fetch_array($result)) {
    echo "<option value='". $row[0] ."'>". $row[1] . "</option>";
}
echo "</select>";
echo "</td></tr>";
echo "<!--Vehicle-->";
echo "<tr><td>Select the vehicle";
echo "</td><td>";

$query = "SELECT vehicles.ID,series.make,series.model,series.version
FROM (vehicles join series on vehicles.chassis = series.id)
WHERE vehicles.userID = '$id'
";
$result = mysqli_query($ms,$query);
echo "<select name='vehicle'>";
while ($row = mysqli_fetch_array($result)) {
	$name = $row[1]." ".$row[2]." ".$row[3];
    echo "<option value='". $row[0] ."'>". $name . "</option>";
}
echo "</select>";
echo "	<a href='newveh.php'>Create vehicle</a>";
echo "<br>";
echo "</td></tr>";
//<!--Time-->
echo "<tr><td>Insert the time";
echo "</td><td>";
echo "<input type='time' name='time'> <br>";
echo "</td></tr></table>";
echo "<button class='normal' type='submit'>Submit</button>";
echo "</form>";
echo "<br>";
echo "</p>";
} else {
$track	=$_POST['track'];
$veh	=$_POST['vehicle'];
$time	=$_POST['time'];
echo "Lap submitted"."<br>";
echo $track."<br>";
echo $veh."<br>";
echo $time."<br>";

$query = "INSERT INTO `LAPS` (`userid`,`trackid`,`time`,`carid`,`GPS`)
        VALUES (".$id.", ".$track.", ".$time.", ".$veh.", "."0 )";
  $r = mysqli_query($ms, $query);
echo $query;
}
?>
</div>
</body>
</html>