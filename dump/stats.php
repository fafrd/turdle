<?php
session_start();

//make sure user is logged in
if ($_SESSION['userid'] == 0)
{
	header("location:/login/");
}
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<title>Turdle - Statistics</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link href="/ratchet/css/ratchet.css" rel="stylesheet">
		<link href="/theme/theme.css" rel="stylesheet">
        <?php
                $link = mysqli_connect($_ENV['db_host'], $_ENV['db_user'], $_ENV['db_password'], $_ENV['db_name']);
 				session_start();
 				$name = isset($_SESSION['name']) ? $_SESSION['name'] : null;
				$userid = (isset($_SESSION['userid']) ? $_SESSION['userid'] : null);
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT MAX(d_dumpid) FROM dump WHERE d_userid='$userid'"));
 				$dumpid = $result[0];
 				
 				$avgtime = $longtime = $shorttime = $avgsize = $bigsize = $smallsize = "NO DATA";
 				
 				//Time Variables
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT AVG(d_dumptime_length) FROM dump WHERE d_userid='$userid'"));
 				$avgtime = $result[0];
 				
 				//Size Variables
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT d_size FROM dump WHERE d_dumpid='$dumpid'"));
  				$size = $result[0]; 				
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT AVG(d_size) FROM dump WHERE d_userid='$userid'"));
 				$avgsize = $result[0]; 				
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT MAX(d_size) FROM dump WHERE d_userid='$userid'"));
				$bigsize = $result[0];
				$result = mysqli_fetch_array(mysqli_query($link, "SELECT MIN(d_size) FROM dump WHERE d_userid='$userid'"));
 				$smallsize = $result[0];
 				
 				
 				//Type Variables
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT d_type FROM dump WHERE d_dumpid='$dumpid'"));
 				$type = $result[0];
 				
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT d_type from
													( 
													SELECT   d_type, COUNT(d_type) AS type_occurrence
													FROM     dump
													WHERE d_userid = '$userid'
													GROUP BY d_type
													ORDER BY type_occurrence DESC
													LIMIT    1 ) as counts"));
				$mosttype = $result[0];
													
 				//Color Variables
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT d_color FROM dump WHERE d_dumpid='$dumpid'"));
 				$color = $result[0];
 				
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT d_color from
													( 
													SELECT   d_color, COUNT(d_color) AS color_occurrence
													FROM     dump
													WHERE d_userid = '$userid'
													GROUP BY d_color
													ORDER BY color_occurrence DESC
													LIMIT    1 ) as counts"));
				$mostcolor = $result[0];
 		?>
	</head>

	<body>
		<header class="bar bar-nav">
			<a href="/index.php" class="icon icon-left-nav pull-left"></a>
			<h1 class="title">Turd Statistics</h1>
		</header>

		<div class="content">
			<h1 class="content-padded centered">Statistics</h1>
			<div class="card">
				<ul class="table-view">
					<li class="table-view-cell"><i>Average Size:</i> 
						<b>
							<?php echo $avgsize ?>/10
						</b>
					</li>
					<li class="table-view-divider"></li>
					<li class="table-view-cell"><i>Average Time:</i> 
						<b>
							<?php echo floor($avgtime) ?> seconds
						</b>
					</li>
					<li class="table-view-divider"></li>
					<li class="table-view-cell"><i>Most Common Type:</i> 
						<b>
							<?php echo $mosttype ?>
						</b>
					</li>
					<li class="table-view-divider"></li>
					<li class="table-view-cell"><i>Most Frequent Color:</i> 
						<?php 
						if($mostcolor == '1')
							echo '<img class="statscolor" src="/images/dark brown.png">';
						else if($mostcolor == '2')
							echo '<img class="statscolor" src="/images/standard brown.png">';
						else if($mostcolor == '3')
							echo '<img class="statscolor" src="/images/light brown.png">';
						else if($mostcolor == '4')
							echo '<img class="statscolor" src="/images/yellow brown.png">';
						else if($mostcolor == '5')
							echo '<img class="statscolor" src="/images/green.png">';
						else if($mostcolor == '6')
							echo '<img class="statscolor" src="/images/red brown.png">';
						?>
					</li>
				</ul>
			</div>
			<br>

			<h1 class="content-padded centered">Charts</h1>
			<div class="card">
				<ul class="table-view">
					<li class="table-view-cell">Size vs. Time Taken</li>
					<li class="table-view-cell">
						<p class=""><i>Not enough data to create chart :(</i></p>
					</li>
					<li class="table-view-divider"></li>

					<li class="table-view-cell">Most Common Color</li>
					<li class="table-view-cell">
						<p class=""><i>Not enough data to create chart :(</i></p>
					</li>
					<li class="table-view-divider"></li>

					<li class="table-view-cell">Turd Type over time</li>
					<li class="table-view-cell">
						<p class=""><i>Not enough data to create chart :(</i></p>
					</li>
<!-- 						<img src="/images/turdle.png" title="Turdle" style="display: block;margin-left: auto;margin-right: auto;width:65%">
-->
				</ul>
			</div>

		</div>

	</body>
</html>
