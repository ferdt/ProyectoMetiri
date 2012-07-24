<?php // signup.php
include_once 'dbconfig.php';
if (!isset($_POST['submitok'])){
// Display the user signup form
?>
<html >
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
  <h1>New User Registration Form</h1>
  <p><font color="orangered" size="+1"><tt><b>*</b></tt></font> indicates a required field</p>
  <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
    <table border="0" cellpadding="0" cellspacing="5">
      <tr>
        <td align="right">
          <p>User name</p>
        </td>
        <td>
          <input name="newname" type="text" maxlength="100" size="25" />
         <font color="orangered" size="+1"><tt><b>*</b></tt></font>
       </td>
    </tr>
    <tr>
    <tr>
      <td align="right">
        <p>E-Mail Address</p>
      </td>
      <td>
        <input name="newemail" type="text" maxlength="100" size="25" />
        <font color="orangered" size="+1"><tt><b>*</b></tt></font>
      </td>
    </tr>
    <tr>
      <td align="right">
        <p>Password</p>
      </td>
      <td>
        <input name="newpass" type="password" maxlength="100" size="25" />
        <font color="orangered" size="+1"><tt><b>*</b></tt></font>
      </td>
    </tr>
	<tr>
      <td align="right">
        <p>Confirm password</p>
      </td>
      <td>
        <input name="newpass2" type="password" maxlength="100" size="25" />
        <font color="orangered" size="+1"><tt><b>*</b></tt></font>
      </td>
    </tr>
	
	<tr>
      <td align="right">
        <p>Country</p>
      </td>
      <td>
	  
		<?php
		$query = "SELECT * FROM countries
		ORDER BY name";
		$result = mysqli_query($ms,$query);
		echo "<select name='country'>";
		while ($row = mysqli_fetch_array($result)) {
			echo "<option value='". $row[0] ."'>". $row[1] . "</option>";
		}
		echo "</select>";
		?>
      </td>
    </tr>
	
    <tr>
      <td align="right" colspan="2">
        <hr noshade="noshade" />
		<br>
        <button class="normal" type="reset">Reset Form</button>
        <button class="normal" type="submit" name="submitok">   OK   <button/>
      </td>
    </tr>
  </table>
</form>
</div>
</body>
</html>

<?php
}
else{
// Process signup submission
// echo "Form submitted"."<br>";
// echo $_POST['newname']."<br>";
// echo $_POST['newemail']."<br>";
// echo $_POST['newpass']."<br>";

if ($_POST['newname']=='' OR $_POST['newpass']=='' OR $_POST['newemail']=='') {
echo('One or more required fields were left blank.\\n'.
'Please fill them in and try again.');
}

 // Check for existing user with the new id
$sql = "SELECT COUNT(*) FROM users WHERE name = '$_POST[newname]'";
//echo $sql;
$result = mysqli_query($ms,$sql);
$result = mysqli_fetch_row($result);
$result = $result[0];

if ($result>0) {
echo('A user already exists with your chosen userid.<br>'.
'Please try another.');
exit;
}

// Check for passwords
if ($_POST['newpass'] <> $_POST['newpass2']){
echo('Password does not coincide.<br>'.
'Please try again.');
exit;
}

?>
<html>
<head>
<title> Registration Complete </title>
<meta http-equiv="Content-Type"
content="text/html; charset=iso-8859-1" />
</head>
<body>
<p><strong>User registration successful!</strong></p>
<p>Your userid and password have been emailed to
<strong><?=$_POST['newemail']?></strong> (mentira), the email address
you just provided in your registration form. To log in,
click <a href="index.php">here</a> to return to the login
page, and enter your new personal userid and password.</p>
</body>
</html>

<?php
$name = $_POST['newname'];
$email= $_POST['newemail'];
$pass = $_POST['newpass'];

  $add = "INSERT INTO `users` (`name`,`password`,`email`,`countryid`) "
        ."VALUES ('".$_POST['newname']."', "
        ."PASSWORD('".$_POST['newpass']."'), "
        ."'".$_POST['newemail']."',"
		."'".$_POST['country']
		."')";
  $r = mysqli_query($ms, $add);
  echo $add;
}
?>