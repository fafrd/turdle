<!DOCTYPE html>
<?php
session_start();

//make sure user is logged in
if ($_SESSION['userid'] == 0)
{
	header("location:/login/");
}
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Turdle - New Dump</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link href="/ratchet/css/ratchet.css" rel="stylesheet">
		<link href="/theme/theme.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="/theme/image-picker/image-picker.css">
		<script src="/theme/js/jquery-2.1.1.js"></script>
		<script src="/theme/image-picker/image-picker.js" type="text/javascript"></script>
	</head>

	<body>
		<header class="bar bar-nav">
			<a class="icon icon-left-nav pull-left" href="/index.php" data-transition="slide-out"></a>
			<h1 class="title">New Dump</h1>
		</header>

		<div class="content">
			<p class="content-padded">Start the timer whenever you're ready, then stop it when you're done wiping.</p>
			<p class="content-padded">Make sure you're <a href="/login">logged in</a> before continuing!</p>
			<form action="insertdump.php" method="post" class="input-group">
 				<div class="input-row centered">
					<h4 class="content-padded" id="countup" style="display:inline-block;margin:0px;">
						<time>00:00:00</time>
					</h4>
 				</div>
 				<div class="input-row">
	 				<label>
 						<div style="padding-left:0px;">Timer</div>
	 				</label>
 					<div class="centered" style="width:65%;float:right;display:inline-block;padding-right:20px;padding-top:3px;">
	 					<button type="button" id="startstop">Start/Stop</button>&nbsp;&nbsp;
						<button type="button" id="clear">Reset</button>
					</div>
 				</div> 				
				<div class="input-row" style="padding-right:20px;">
					<label>Size</label>
					<div style="padding-left:30px;padding-right:15px;">
						<input type="range" name="size" min="1" max="10" value="5" style="padding-top:5px;">
					</div>
				</div>
				<div class="input-row" style="border-bottom:initial;">
					<label>Type</label>
					<select name="type" id="dumptype"required>
						<option value="type1">Type 1 - small lumps</option>
						<option value="type2">Type 2 - lumpy sausage</option>
						<option value="type3">Type 3 - cracked sausage</option>
						<option selected value="type4">Type 4 - smooth sausage</option>
						<option value="type5">Type 5 - soft blobs</option>
						<option value="type6">Type 6 - mushy pieces</option>
						<option value="type7">Type 7 - watery liquid</option>
					</select>
				</div>
				<div class="input-row" style="border-top:initial;text-align:center">
					<a onclick="setStoolChartSize();">Open Bristol Stool Chart</a>
				</div>
				<div class="input-row" id="stoolchart" style="display:none;">
					<img id="stoolchartimage" style="padding-top: 10px;" src="/images/Bristol_stool_chart.svg">
				</div>
				<div class="input-row" style="height: initial;">
					<label style="width:initial;">Color</label>
					<select id="colorelement" name="color" class="image-picker show-html">
						<option data-img-src="/images/dark brown.png" value="1">Dark Brown</option>
						<option data-img-src="/images/standard brown.png" value="2">Standard Brown</option>
						<option data-img-src="/images/light brown.png" value="3">Light Brown</option>
						<option data-img-src="/images/yellow brown.png" value="4">Yellow Brown</option>
						<option data-img-src="/images/green.png" value="5">Green</option>
						<option data-img-src="/images/red brown.png" value="6">Red</option>
					</select>
				</div>
				<br>
				<div class="content-padded">
					<button onclick="finalize();getLocation();" class="btn btn-primary btn-block" type="submit">Submit Turd</button>					
				</div>
			<input name="length" id="lengthelement" type="text" style="display:none;">
			<input name="starttime" id="starttime" type="text" style="display:none;">
			<input name="stoptime" id="stoptime" type="text" style="display:none;">
			<input name="lat" id="lat" type="text" style="display:none;">
			<input name="long" id="long" type="text" style="display:none;">				
			</form>
		</div>

		<script src="/theme/js/stopwatch.js"></script>
		<script type="text/javascript">
			function finalize()
			{
				if(isTimerRunning)
				{
					stoptime = new Date();
				}
				length = stoptime - starttime;
				length /= 1000;
				document.getElementById("lengthelement").value = Math.floor(length);
				document.getElementById("starttime").value = starttime.toISOString().slice(0, 19).replace('T', ' ');
				document.getElementById("stoptime").value = stoptime.toISOString().slice(0, 19).replace('T', ' ');
			}
			
			function getLocation() {
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(showPosition);
				} else { 
					document.getElementById("lat").value = "";
					document.getElementById("long").value = "";
				}
			}

			function showPosition(position) {
				document.getElementById("lat").value = position.coords.latitude;
				document.getElementById("long").value = position.coords.longitude;	
			}

			function setStoolChartSize() {
				$('#stoolchart').toggle();
				$('#stoolchart').height((document.getElementById('stoolchartimage').clientHeight) + 10);
			}
			getLocation();
			setTimeout(function(){$("select").imagepicker()},200);
			setTimeout(function(){$('#dumptype').show()},250);
		</script>
	</body>
</html>
