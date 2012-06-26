<html>

<head>

</head>
<body>

<?php

if (!isset($_POST['username'])) {
// form not submitted
?>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">

Username: <input type="text" name="username" size="65"> <br>
Password: <input type="text" name="password" size="65"> <br>
Email: <input type="text" name="email" size="65"> <br>

<input type="submit" value="Add user">

</form>

<?php
}
else {
// retrieve form data
$username	=$_POST['username'];
$password	=$_POST['password'];
$email		=$_POST['email'];

// Connect to DB
  $host = "localhost";
  $user = "root";
  $pass = "";
  $db = "Metiri";
  
  $ms = mysqli_connect($host, $user, $pass, $db);
  if ( !$ms )
  {
    echo "Error connecting to database.\n";
  }

//Insert data
  $add = "INSERT INTO `Users` (`username`,`password`,`email`) "
        ."VALUES ('".$_POST["username"]."', "
        ."PASSWORD('".$_POST["password"]."'), "
        ."'".$_POST["email"]."')";
  $r = mysqli_query($ms, $add);
  
 //If succesful, retrieve data from DB
echo "<h1>User added</h1>";
echo "User: <i>$username</i><br />";
echo "Password: <i>$password</i><br />";
echo "Email: <i>$email</i><br />";
echo "<h1>Rest</h1>";
echo "Rest of users in the DB:<br />";
echo "<br />";
  
$query  = 'SELECT * FROM users';
$result = mysqli_query($ms,$query);
    
  if (mysqli_num_rows($result) > 0) {
    echo "<table>";
	echo "<tr>";
	echo "<td><b>User</b></td><td><b>Password</b></td><td><b>Email</b></td>";
	echo "</tr>";
    while($row = mysqli_fetch_row($result)) {
        echo "<td>".$row[1]."</td>";
        echo "<td>" . $row[2]."</td>";
        echo "<td>".$row[3]."</td>";
		echo "<td><a href=".$_SERVER['PHP_SELF']."?id=".$row[0].">Delete</a>";
        echo "</tr>";
    }
    echo "</table>";
}
else {
    echo "No rows found!";
}

	if (isset($_GET['id'])) {
// create query to delete record
    $query = "DELETE FROM symbols WHERE id = ".$_GET['id'];
// execute query
    $result=mysqli_query($ms,$query); 
}
}
?>


</body>

</html>