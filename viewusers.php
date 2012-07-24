<html>
<head>
<link rel="stylesheet" type="text/css" href="style/basic1.css" />
</head>
<body>
<?php
include ("header.php");
?>
<div id='page-wrap'>
<h1>List of users</h1>
<p>These are the users present in DB</p>
<?php

include ("dbconfig.php");
  
$query  = 'SELECT * FROM users
ORDER BY userid';
$result = mysqli_query($ms,$query);
  
  if (mysqli_num_rows($result) > 0) {
    echo "<table class='ListTable'>";
	echo "<tr>";
	echo "<th>User</th>
		<th>Email</th>
		<th>Registered on</th>";
	echo "</tr>";
    while($row = mysqli_fetch_row($result)) {
        echo "<td><a href="."user.php"."?id=".$row[0].">".$row[1]."</a></td>";
        echo "<td>".$row[3]."</td>";
		echo "<td>".date('dS \of F Y',strtotime($row[5]))."</td>";
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