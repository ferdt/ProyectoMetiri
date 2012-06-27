<html>
<head>
<link rel="stylesheet" type="text/css" href="style/facebook.css" />
</head>
<body>
<?php

include ("DBConfig.php");
$id = $_GET['id'];
//$id	= 1;
$query  = "SELECT * FROM users WHERE userID = '$id'";
$result = mysqli_query($ms,$query);
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_row($result);
	echo "<h1>".$row[1]."</h1>";
	echo "<P>";
	
	$query  = "SELECT * FROM laps WHERE userID = '$id' ORDER BY  `laps`.`SessionID` ASC";
	$result = mysqli_query($ms,$query);
  

  if (mysqli_num_rows($result) > 0) {
    echo "<table>";
	echo "<tr>";
	echo "<th>LapSession</th><th>Track</th><th>Time</th><th>Car</th>";
	echo "</tr>";
    while($row = mysqli_fetch_row($result)) {
        echo "<td>".$row[5]."</td>";
        echo "<td>" . $row[2]."</td>";
        echo "<td>".$row[3]."</td>";
		echo "<td>".$row[4]."</td>";
		echo "<td><a href="."user.php"."?id=".$row[0].">View</a>";
        echo "</tr>";
    }
    echo "</table>";
}
	
	
	
	
	echo "</P>";
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	}
 else {
    echo "No user found!";
	}

	
	
	
?>

</body>

</html>