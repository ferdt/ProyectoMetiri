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
<h1>Create vehicle</h1>
<p>A new vehicle will be added to your garage.<br>
<!--Make-->
Select make<br>
<?php
$query = "SELECT DISTINCT make FROM series
Order by make ASC";
$result = mysqli_query($ms,$query);
echo "<select>";
while ($row = mysqli_fetch_array($result)) {
    echo "<option value='make'>". $row[0] . "</option>";
}
echo "</select>";
echo "</p>";
?>
<!--Model-->
<p>Select model<br>
<?php
$query = "SELECT * FROM series
WHERE series.make='make'
GROUP BY model";
$result = mysqli_query($ms,$query);
echo "<select>";
while ($row = mysqli_fetch_array($result)) {
    echo "<option value='". $row[2] ."'>". $row[2] . "</option>";
}
echo "</select>";
echo "</p>";



?>
</div>
</body>
</html>