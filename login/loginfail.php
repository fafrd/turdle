<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Turdle - Log In Failure</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link href="/ratchet/css/ratchet.css" rel="stylesheet">
		<link href="/theme/theme.css" rel="stylesheet">
	</head>

	<body>
		<header class="bar bar-nav">
			<a class="icon icon-left-nav pull-left" href="/login/" data-transition="slide-out"></a>
			<h1 class="title">Log In Failure</h1>
		</header>

		<div class="content">
			<h1 class="content-padded">:(</h1>
			<h4 class="content-padded">There was something wrong with your username or password.</h4>
			<p class="content-padded">
			<br>
			<div class="content-padded">
				<form action="/login/">
					<button class="btn btn-primary btn-block" type="submit">Log In</button>		
				</form>
				<form action="/login/newaccount.php">
					<button class="btn btn-primary btn-block" type="submit">Create Account</button>
				</form>
			</div>
			</form>
		</div>

	</body>
</html>