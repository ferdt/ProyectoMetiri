<?php include('sessioncontrol.php'); ?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style/basic1.css" />
</head>
<body>
<?php
set_time_limit ( 160 );
include_once ('dbconfig.php');
include ('header.php');
$id = $_SESSION['uid'];
//New session
$query="SELECT max(laps.sessionid)
	FROM laps
	";
$result = mysqli_query($ms, $query);
$lapsession=mysqli_fetch_row($result);
$lapsession=$lapsession[0]+1;
//New lap
$query="SELECT max(laps.lapid)
	FROM laps
	";
$result = mysqli_query($ms, $query);
$lapid=mysqli_fetch_row($result);
$lapid=$lapid[0]+1;
$lap=0;
//loads tracks
$query = "SELECT * FROM tracks
";
$result = mysqli_query($ms,$query);

//File form
echo "<div id='page-wrap'>";
echo "<h1>Upload file</h1>";
echo "<br>";
echo "<form action=".$_SERVER['PHP_SELF']." method='POST' enctype='multipart/form-data'>";
echo "Select the track<br>";
echo "<td><select name='track'>";
while ($row = mysqli_fetch_array($result)) {
    echo "<option value='". $row[0] ."'>". $row[1] . "</option>";
}
echo "</select>";
echo "<br>";
echo "<br>";
echo "Choose a file to upload: <input type='file' name='file' value='' />";
echo "<input type='submit' value='Upload file' name='upload' class='normal' />";
echo "</form>";


if ($_FILES) {
	//Track info
	$query = "SELECT * FROM tracks
	WHERE id=".$_POST['track'];
	$result = mysqli_query($ms,$query);
	$row	=	mysqli_fetch_row($result);
	$trackname = $row[1];
	$track = $row[0];
	
	echo "<br>Track: ".$row[1];
	$x=$row[3];
	$y=$row[4];
	$b=$row[5];
	$w=$row[6];
	
	$pend=tan($b*pi()/180);
	if (($b > 90) AND ($b < 270)) { $cond = -1;} else { $cond = 1;}
	echo "<br>Cond: ".$cond;
	echo "<br>Bear: ".$b;
	echo "<br>Pend: ".$pend;
	
	//init variables
	$maxspeed=0;
	$flag=0;
	$flag_ant=0;
	//$time0=0;
	$gps=2;
	
	
	// load file
	$file=$_FILES["file"]["tmp_name"];
	$xml = simplexml_load_file($file) or die ("Unable to load XML file!");
	echo "<br>";
	echo "<br>File name: ".$xml->trk->name."<br>";
	echo "<br>";
	
	
	//point parsing
	foreach ($xml->trk->trkseg->trkpt as $trkpt) {
		$lat = floatval($trkpt['lat']);
		$lon = floatval($trkpt['lon']);
		$ele	= floatval($trkpt->ele);
		$time	= strtotime($trkpt->time);
		$course	= floatval($trkpt->course);
		$speed	= floatval($trkpt->speed);
		
		//lap calculation
		$maxspeed=max($maxspeed,$speed);
		
		$dlat	= ($lat-$x)*pi()/180;
		$dlon	= ($lon-$y)*pi()/180;
		$Dmeta = sqrt(pow($dlat,2)+pow($dlon,2))*6400000;
		//$a		= pow(sin($dlat*pi()/360),2)+cos($lat*pi()/180)*cos($x*pi()/180)*pow(sin($dlon*pi()/360),2);
		//$c		= 2*atan2(sqrt($a),sqrt(1-$a));
		//$d		= 6400000*$c;
		$Splano = $y+$pend*($lat-$x);
		if (!isset($st)) { $st = $Splano/$lon;}
		if (($Splano/$lon > 1) AND ($st < 1) AND ($Dmeta < 125)) {
			if (isset($time0)) {
				$lap=$lap+1;
				$lapid=$lapid+1;
				//echo "LAP ".$lap."<br>"."<br>"."<br>"."<br>"."<br>"."<br>"."<br>";
				$laptime=$time-$time0;
				$time0=$time;
				$maxspeed=$maxspeed;
				$query = "INSERT into laps (lapid, userid, trackid, time, carid, maxspeed, sessionid, lapnumber, gps)
					VALUES (".$lapid.",".$_SESSION['uid'].",".$track.",".$laptime.","."1".",".$maxspeed.",".$lapsession.",".$lap.",". $gps.")";
				//echo $query;
				$r = mysqli_query($ms, $query);
				$maxspeed=0;
			} else {
				$time0=$time;
				//echo $time0;
			}
		}
		$st = $Splano/$lon ;
		//point inclusion
		$query = "INSERT into raw (session, lapid, lat, lon, ele, time, course, speed)
			VALUES (".$lapsession.",".$lapid.",".$lat.",". $lon.",". $ele.",'". $time."',". $course.",". $speed.")";
		$r = mysqli_query($ms, $query);
		//echo "<br>".$query;
		//echo "<br>".$r;
	}
	

	echo "<br><br><br><br><br><br><br><br><br><br>";
	// foreach ($xml->xpath('//trkpt') as $trkpt) {
		// $lat = $trkpt['lat'];
		// $lon = $trkpt['lon'];
		// $ele = $trkpt->ele;
		// echo "foreach xpath lat: ".$lat."<br>";
		// echo "foreach xpath lon: ".$lon."<br>";
		// echo "foreach xpath ele: ".$ele."<br>";
	// }

	echo "<br>File uploaded";
}
?>
</div>
</body>
</html>