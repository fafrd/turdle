<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Turdle - New Account</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link href="/ratchet/css/ratchet.css" rel="stylesheet">
		<link href="/theme/theme.css" rel="stylesheet">
	</head>

	<body>
		<header class="bar bar-nav">
			<a class="icon icon-left-nav pull-left" href="/index.php" data-transition="slide-out"></a>
			<h1 class="title">Create New Account</h1>
		</header>

		<div class="content">
			<p class="content-padded">Enter your email and your desired password below, along with a few details about yourself.</p>
			<form action="checknewaccount.php" method="post" class="input-group">
				<div class="input-row">
					<label>E-mail</label>
					<input required type="email" name="email" maxlength="50" placeholder="poo@gmail.com">
				</div>
				<div class="input-row">
					<label>Password</label>
					<input required type="password" name="password" maxlength="50" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
				</div>
				<br>
				<div class="input-row">
					<label>Name</label>
					<input required type="text" name="name" maxlength="50" placeholder="John Doe">
				</div>
				<div class="input-row">
					<label>Age</label>
					<input required type="number" name="age" maxlength="50" placeholder="21">
				</div>
				<div class="input-row">
					<label>Gender</label>
					<select required name="gender">
						<option disabled>select...</option>
						<option value="f">female</option>
						<option value="m">male</option>
						<option value="o">other
					</select>
				</div>
				<div class="input-row">
					<label>Height</label>
					<!--
					<input required type="number" name="feet" maxlength="2" placeholder="feet"
						style="width:32%;float:left;">
					<input required type="number" name="inches" maxlength="2" placeholder="inches"
						style="width:32%;float:right;">
					-->
					<select required type="number" name="feet" style="width:30%;float:left;padding-left:2px;">
						<option disabled>feet</option>
						<option value="1">1 foot</option>
						<option value="2">2 feet</option>
						<option value="3">3 feet</option>
						<option value="4">4 feet</option>
						<option value="5">5 feet</option>
						<option value="6">6 feet</option>
						<option value="7">7 feet</option>
						<option value="8">8 feet</option>
					</select>
					<select required type="number" name="inches" style="width:32%;float:right;">
						<option disabled>inches</option>
						<option value="0">0 inches</option>
						<option value="1">1 inch</option>
						<option value="2">2 inches</option>
						<option value="3">3 inches</option>
						<option value="4">4 inches</option>
						<option value="5">5 inches</option>
						<option value="6">6 inches</option>
						<option value="7">7 inches</option>
						<option value="8">8 inches</option>
						<option value="9">9 inches</option>
						<option value="10">10 inches</option>
						<option value="11">11 inches</option>
					</select>
				</div>
				<div class="input-row">
					<label>Weight</label>
					<input required type="number" name="weight" maxlength="50" placeholder="165" step="1">
				</div>
				<p class="content-padded">Your information will be kept confidential and anonymous.</p>
				<br>
				<div class="content-padded">
					<button class="btn btn-primary btn-block" type="submit">Create Account</button>					
				</div>
			</form>
		</div>

	</body>
</html>
