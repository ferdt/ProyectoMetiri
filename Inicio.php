<html>
 <head>
<table class='header'>
<tr>
<th><a href=inicio.php>Home</a></th>
</tr>
</table>
   
<title>Proyecto Metiri: Home</title>
<link rel="stylesheet" type="text/css" href="style/home1.css" />
</head>
<body>

<div id="page-wrap">
<h1>Log in</h1>

<p>
<form action="login.php" method="post">
<table><tr>
	<td>username: &nbsp; </td><td> <input type="text" name="name"></td></tr>
    <tr><td>password: &nbsp; </td><td> <input type="password" name="pwd"></td></tr>
</table>
<br>
    <button class="normal" type="submit">Log in</button>
</form>
</p>
<p>
Or <a href="signup.php">Sign up</a>
</p><p>
<?php echo(date("l F d, Y")); ?>
</p>
</div>
</body>
</html> 