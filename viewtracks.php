<html>
<head>
<link rel="stylesheet" type="text/css" href="style/basic1.css" />
</head>
<body>
<?php
include ("header.php");
?>
<div id='page-wrap'>
<h1>List of tracks</h1>
<p>These are the tracks present in DB</p>
<?php

include ("dbconfig.php");
  
$query  = 'SELECT * FROM tracks';
$result = mysqli_query($ms,$query);
  
  if (mysqli_num_rows($result) > 0) {
    echo "<table class='ListTable'>";
	echo "<tr>";
	echo "<th>Track</th>
		<th>Country</th>";
	echo "</tr>";
    while($row = mysqli_fetch_row($result)) {
        echo "<td><a href="."track.php"."?id=".$row[0].">".$row[1]."</a></td>";
        echo "<td>" . $row[2]."</td>";
        echo "</tr>";
    }
    echo "</table>";
}
else {
    echo "No rows found!";
	}

?>

</div>
</body>

</html>