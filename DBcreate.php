<?php
include ("DBConfig.php");
// Connect to MySQL
// mysql_connect('host', 'database', 'password') or die (mysql_error());
// Select database
// mysql_select_db('database') or die (mysql_error());
//Create the table users
mysql_query("create table users(
   userID int(8) NOT NULL, 
   username varchar(65) NOT NULL,
   password varchar(20) NOT NULL, 
   email varchar(65) NOT NULL,
   PRIMARY KEY userID
)"); or die (mysql_error());
//Show "Complete" if everything works
echo "Table `users` created."."<br>";

//Create the table tracks
mysql_query("create table tracks(
   ID int(8) NOT NULL, 
   Name varchar(65) NOT NULL,
   Country varchar(65) NOT NULL,
   StartX float(11,5) NOT NULL,
   StartY float(11,5) NOT NULL,
   StartB float(11,5) NOT NULL,
   Width int(3) NOT NULL,
   PRIMARY KEY (ID)
)") or die (mysql_error());
//Show "Complete" if everything works
echo "Table `tracks` created."."<br>";

//Create the table vehicles
mysql_query("create table vehicles(
   ID int(8) NOT NULL, 
   name varchar(30) NOT NULL,
   Type int(1) NOT NULL,
   Chassis int(8) NOT NULL,
   Engine int(8) NOT NULL,
   Class int(2) NOT NULL,
   PRIMARY KEY (ID)
)") or die (mysql_error());
//Show "Complete" if everything works
echo "Table `vehicles` created."."<br>";

//Create the table laps
mysql_query("create table laps(
   LapID int(12) NOT NULL, 
   UserID int(8) NOT NULL,
   TrackID int(8) NOT NULL,
   Time float(6,2) NOT NULL,
   CarID int(8) NOT NULL,
   Timestamp timestamp NOT NULL,
   SessionID int(12) NOT NULL,
   Lapnumber int(3) NOT NULL,
   GPS bit(1) NOT NULL,
   PRIMARY KEY (LapID)
)") or die (mysql_error());
//Show "Complete" if everything works
echo "Table `laps` created."."<br>";


?>