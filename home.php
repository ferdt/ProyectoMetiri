<html>
<head>
<link rel="stylesheet" type="text/css" href="style/basic1.css" />

<?php include ('header.php'); ?>

<title>Proyecto Metiri: Home</title>
</head>
<body>

<?php
echo "<p style='font: 14pt/20pt Garamond, Georgia, serif;color:red;'>";
include ('accesscontrol.php');
include_once ('DBConfig.php');
echo "</p>";
echo "<div id='page-wrap'>";
?>
<h1>Start Menu</h1>
<p>
In this page you can perform several actions such as:
<form>
<button class="normal" type="submit">Upload file</button><br>
<button class="normal" type="submit">Create car</button><br>
</form>
</p>
</div>
</body>
</html>