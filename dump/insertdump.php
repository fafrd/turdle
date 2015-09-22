<?php

// Enable error reporting
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

session_start();

// Connect to database
$link = mysqli_connect('localhost', 'root', 'password', 'turdle');

//Grab User Info
$name = (isset($_SESSION['name']) ? $_SESSION['name'] : null);
$userid = (isset($_SESSION['userid']) ? $_SESSION['userid'] : null);

// Taking form info and placing into variables
$size = (isset($_POST['size']) ? $_POST['size'] : null);
$type = (isset($_POST['type']) ? $_POST['type'] : null);
$color = (isset($_POST['color']) ? $_POST['color'] : null);
$length = (isset($_POST['length']) ? $_POST['length'] : null);
$starttime = (isset($_POST['starttime']) ? $_POST['starttime'] : null);
$endtime = (isset($_POST['stoptime']) ? $_POST['stoptime'] : null);


$lat = (isset($_POST['lat']) ? $_POST['lat'] : null);
$long = (isset($_POST['long']) ? $_POST['long'] : null);

if(!empty($lat) && !empty($long))
{
	//Insert location into location table, make sure it's not a duplicate for the user
	$loc_insert_success = mysqli_query($link, "INSERT INTO location (l_userid, l_latitude, l_longitude, l_comment)
		VALUES ('$userid',
			'$lat',
			'$long',
			'')
	") or die(mysql_error());

	$result = mysqli_fetch_array(mysqli_query($link, "SELECT MAX(l_locationid) FROM location WHERE l_userid='$userid'"));
	$locationid = $result[0];
} else
{
	$locationid = '';
}

// Insert into database DOES NOT INCLUDE dumpid or locationid
$insert_success = mysqli_query($link, "INSERT INTO dump (d_userid, d_locationid, d_color, d_size, d_type, d_dumptime_length, d_dumpstart, d_dumpend)
	VALUES ('$userid',
		'$locationid',
		'$color',
		'$size',
		'$type',
		'$length',
		'$starttime',
		'$endtime')
") or die(mysql_error());

// Check for insert success
if($insert_success)
{

	$result = mysqli_fetch_array(mysqli_query($link, "SELECT MAX(d_dumpid) FROM dump WHERE d_userid='$userid'"));
	$dumpid = $result[0];

	//update statistics numdumps, dumptimetotal, AVGs, most frequent colo
	$numdumps_insert_success = mysqli_query($link, "UPDATE statistics
	SET s_numdumps = s_numdumps + 1
	WHERE s_userid = '$userid'") or die(mysql_error());	

	$dumpavg_insert_success = mysqli_query($link, "UPDATE statistics
	SET s_dumptime_average = (SELECT AVG(d_dumptime_length) FROM dump WHERE d_userid = '$userid')
	WHERE s_userid = '$userid'") or die(mysql_error());
	
	$dumptime_insert_success = mysqli_query($link, "UPDATE statistics
	SET s_dumptime_total = s_dumptime_total + (SELECT d_dumptime_length FROM dump WHERE d_dumpid = '$dumpid')
	WHERE s_userid = '$userid'") or die(mysql_error());	
	
	$sizeavg_insert_success = mysqli_query($link, "UPDATE statistics
	SET s_size_average = (SELECT AVG(d_size) FROM dump WHERE d_userid = '$userid')
	WHERE s_userid = '$userid'") or die(mysql_error());
	
	$mfcolor_insert_success = mysqli_query($link, "UPDATE statistics SET s_color_most_frequent = 
                (SELECT d_color from
				( 
				SELECT   d_color, COUNT(d_color) AS color_occurrence
				FROM     dump
				WHERE d_userid = '$userid'
				GROUP BY d_color
				ORDER BY color_occurrence DESC
				LIMIT    1 ) as counts
		)
		WHERE s_userid = '$userid';
		") or die(mysql_error());




	sleep(0.2);
	header("location:dumpcomplete.php");
}
else
{
	sleep(0.2);
	header("location:dumperror.php");
}
?>
