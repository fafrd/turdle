<?php

// Enable error reporting
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

// Connect to database
$link = mysqli_connect('localhost', 'root', 'password', 'turdle');

session_start();

// username and password sent from form 
$email = (isset($_POST['email']) ? $_POST['email'] : null);
$password = (isset($_POST['password']) ? $_POST['password'] : null);

// To protect MySQL injection (more detail about MySQL injection)
$email = stripslashes($email);
$password = stripslashes($password);
$email = mysqli_real_escape_string($link, $email);
$password = mysqli_real_escape_string($link, $password);
$hashed_password = hash("sha256", $password);

// Check for login
$sql="SELECT * FROM user WHERE u_username='$email' and u_password='$hashed_password'";
$result=mysqli_query($link, $sql);
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count >= 1)
{
	
	if(count($_COOKIE) > 0)
	{
		// destroy cookie
		setcookie(userid, "", time() - 3600);
	}

	$_SESSION['email'] = $email;
	$_SESSION['password'] = $hashed_password; 
	$sql = "SELECT u_name FROM user WHERE u_username='$email' and u_password='$password'";
	$result = mysqli_fetch_array(mysqli_query($link, $sql));
	$_SESSION['name'] = $result[0];
	$sql = "SELECT u_userid FROM user WHERE u_username='$email' and u_password='$hashed_password'";
	$result = mysqli_fetch_array(mysqli_query($link, $sql));
	$_SESSION['userid'] = $result[0];
	
	//if($_SESSION['persistent'])
	//{
		//set cookie
		setcookie("login", $userid, time() + (86400 * 30), "/");
		$_COOKIE['login'] = $userid;
	//}

	header("location:loginsuccess.php");
}
else
{
	header("location:loginfail.php");
}

ob_end_flush();
?>
