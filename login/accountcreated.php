<!DOCTYPE html>
<?php
session_start();
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Turdle - Account Created</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link href="/ratchet/css/ratchet.css" rel="stylesheet">
		<link href="/theme/theme.css" rel="stylesheet">
	</head>

	<body>
		<header class="bar bar-nav">
			<a class="icon icon-left-nav pull-left" href="/index.php" data-transition="slide-out"></a>
			<h1 class="title">Account Created</h1>
		</header>

		<div class="content">
			<h1 class="content-padded">Hello, <?php echo $_SESSION['name'] ?>!</h1>
			<p class="content-padded">Your account has been created.<br>You can now start recording data.</p>
			<br>
			<div class="content-padded">
				<form action="/dump">
					<button type="submit" class="btn btn-primary btn-block">New Dump</button>
				</form>
			</div>
		</div>
	</body>
</html>
