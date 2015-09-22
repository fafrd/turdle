<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Turdle - Error</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link href="/ratchet/css/ratchet.css" rel="stylesheet">
		<link href="/theme/theme.css" rel="stylesheet">
	</head>

	<body>
		<header class="bar bar-nav">
			<a class="icon icon-left-nav pull-left" href="/index.php" data-transition="slide-out"></a>
			<h1 class="title">Account Creation Failed</h1>
		</header>

		<div class="content">
			<h1 class="content-padded">oh noes!</h1>
			<p class="content-padded">Something went wrong. Either an account already exists with that email, or there's something wrong with the server. If you keep getting this error, please <a href="mailto:kbradley@ucmerced.edu">contact us by email</a>.</p>
			<br>
			<div class="content-padded">
				<form action="/login/newaccount.php">
					<button type="submit" class="btn btn-primary btn-block">Create Account</button>
				</form>
			</div>
		</div>
	</body>
</html>