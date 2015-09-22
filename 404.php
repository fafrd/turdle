<?php session_start() ?>

<center>
<h1><b>404</b></h1>
<img src="/images/sadturtle.jpg">
</center>

<h2>Could not access page or page does not exist. If you think this problem was in error, please <a href="mailto:kbradley@ucmerced.edu">contact us by email</a>.

<p>Your session variables are:</p>
<ul>
<li>userid: <?php 
	if (isset($_SESSION['userid'])) { echo $_SESSION['userid']; }
	else { echo "\$_SESSION['userid'] is not set!"; } ?>
</li>


</ul>