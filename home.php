<?php //session_start();
include('sessioncontrol.php');
//$uname=$_SESSION['uname'];
 ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/basic1.css" />

<?php include ('header.php'); ?>

<title>Proyecto Metiri: Home</title>
</head>
<body>

<?php

echo "<p style='font: 14pt/20pt Garamond, Georgia, serif;color:red;'>";
//include ('accesscontrol.php');
include_once ('DBConfig.php');
echo "</p>";
echo "<div id='page-wrap'>";
echo '<h1>Start Menu</h1>';
echo '<p>Welcome '.$uname.'</p>';
?>

<p>
In this page you can perform several actions such as:
<form>
<button class="normal" href="upload.php">Upload file</button><br>
<a href="createcar.php"><button class="normal">Create car</button></a><br>
</form>
</p>
</div>
</body>
</html>