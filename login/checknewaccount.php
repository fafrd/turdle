<?php

// Enable error reporting
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

session_start();

// Connect to database
$link = mysqli_connect($_ENV['db_host'], $_ENV['db_user'], $_ENV['db_password'], $_ENV['db_name']);

// Taking form info and placing into variables
$email = (isset($_POST['email']) ? $_POST['email'] : null);
$password = (isset($_POST['password']) ? $_POST['password'] : null);
$hashed_password = hash("sha256", $password);
$name = (isset($_POST['name']) ? $_POST['name'] : null);
$age = (isset($_POST['age']) ? $_POST['age'] : null);
$gender = (isset($_POST['gender']) ? $_POST['gender'] : null);
$height_feet = (isset($_POST['feet']) ? $_POST['feet'] : null);
$height_inches = (isset($_POST['inches']) ? $_POST['inches'] : null);
$weight = (isset($_POST['weight']) ? $_POST['weight'] : null);

// To protect MySQL injection
/*
$email = stripslashes($email);
$password = stripslashes($password);
$name = stripslashes($name);
$email = mysql_real_escape_string($email);
$password = mysql_real_escape_string($password);
$name = mysql_real_escape_string($name);
*/

$height = ($height_feet * 12) + $height_inches;

$user_exists = mysqli_query($link, "SELECT * FROM user WHERE u_username='$email'");
$user_exists_count = mysqli_num_rows($user_exists);

// Insert into database
$insert_success = mysqli_query($link, "INSERT INTO user (u_username, u_password, u_gender, u_height, u_weight, u_name, u_age, u_signupdate)
	VALUES ('$email',
	    '$hashed_password',
	    '$gender',
	    '$height',
	    '$weight',
	    '$name',
	    '$age',
	    '')
") or die(mysql_error());

// Check for insert success
if($insert_success && $user_exists_count == 0)
{
	// Register email, password and redirect to accountcreated.php
	$_SESSION['email'] = $email;
	$_SESSION['name'] = $name;
	$sql = "SELECT u_userid FROM user WHERE u_username='$email' and u_password='$hased_password'";
	$result = mysqli_fetch_array(mysqli_query($link, $sql));
	$_SESSION['userid'] = $result[0];
	$_SESSION['password'] = $hashed_password;
	
	$userid = $result[0];
	
	//stats creation
	$insert_success = mysqli_query($link, "INSERT INTO statistics (s_userid, s_numdumps, s_dumptime_total, s_dumptime_average, s_dumptime_stddev, s_size_average, s_size_stddev, s_color_most_frequent)  
	VALUES ('$userid',
	    '0',
	    '',
	    '',
	    '',
	    '',
	    '',
	    '')
") or die(mysql_error());
	
	
	header("location:accountcreated.php");
}
else
{
	header("location:newaccountfail.php");
}
?>
