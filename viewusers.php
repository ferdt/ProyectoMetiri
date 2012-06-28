<html>
<head>
<link rel="stylesheet" type="text/css" href="style/facebook.css" />
</head>
<body>
<h1>List of users</h1>
<p>These are the users present in DB</p>
<?php

include ("DBConfig.php");
  
$query  = 'SELECT * FROM users';
$result = mysqli_query($ms,$query);
  
  if (mysqli_num_rows($result) > 0) {
    echo "<table>";
	echo "<tr>";
	echo "<td><b>User</b></td><td><b>Password</b></td><td><b>Email</b></td>";
	echo "</tr>";
    while($row = mysqli_fetch_row($result)) {
        echo "<td><a href="."user.php"."?id=".$row[0].">".$row[1]."</a></td>";
        echo "<td>" . $row[2]."</td>";
        echo "<td>".$row[3]."</td>";
        echo "</tr>";
    }
    echo "</table>";
}
else {
    echo "No rows found!";
	}

?>


</body>

</html>