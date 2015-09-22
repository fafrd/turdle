<!DOCTYPE html>
<?php
ob_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Turdle - Log In</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link href="/ratchet/css/ratchet.css" rel="stylesheet">
		<link href="/theme/theme.css" rel="stylesheet">
	</head>

	<body>
		<header class="bar bar-nav">
			<a class="icon icon-left-nav pull-left" href="/index.php" data-transition="slide-out"></a>
			<h1 class="title">Log In to Turdle</h1>
		</header>

		<div class="content">
		<?php
			if(isset($_SESSION['name']))
			{
				echo '<h4 class="content-padded centered"><i>You\'re already logged in as '; echo $_SESSION['name']; echo '</i></h4>';
				echo '<p class="content-padded">You can <a href="/dump/index.php">click here to record a new dump</a>, or log in as a different user below.</p><br>';
			}

		?>
			<p class="content-padded">Enter your username and password below, or <a href="newaccount.php">click here</a> to create a new account.</p>
			<p class="content-padded"><b>UPDATE:</b> We're working on setting up a persistent login so you stay logged in. It's a work in progress. I have to write a bunch of php.</p>
			<form action="checklogin.php" method="post" class="input-group">
				<div class="input-row">
					<label>E-mail</label>
					<input type="email" name="email" maxlength="50" placeholder="poo@gmail.com" required>
				</div>
				<div class="input-row">
					<label>Password</label>
					<input type="password" name="password" maxlength="50" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" required>
				</div>
				<div class="input-row">
					<label><i>stay logged in?</i></label>
					<input type="checkbox" name="persistent" style="float:initial;vertical-align:bottom;width:13px;position:relative;">
				</div>
				<br>
				<div class="content-padded">
					<button class="btn btn-primary btn-block" type="submit">Log In</button>					
				</div>
			</form>
		</div>

	</body>
</html>
