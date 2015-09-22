<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Turdle - Dump Completed</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link href="/ratchet/css/ratchet.css" rel="stylesheet">
		<link href="/theme/theme.css" rel="stylesheet">
		<?php $link = mysqli_connect('localhost', 'root', 'password', 'turdle');
 				session_start();
 				$name = isset($_SESSION['name']) ? $_SESSION['name'] : null;
				$userid = (isset($_SESSION['userid']) ? $_SESSION['userid'] : null);
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT MAX(d_dumpid) FROM dump WHERE d_userid='$userid'"));
 				$dumpid = $result[0];
 				
 				$avgtime = $longtime = $shorttime = $avgsize = $bigsize = $smallsize = "NO DATA";
 				
 				//Time Variables
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT d_dumpstart FROM dump WHERE d_dumpid='$dumpid'"));
 				$start = $result[0];
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT d_dumpend FROM dump WHERE d_dumpid='$dumpid'"));
 				$end = $result[0];
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT d_dumptime_length FROM dump WHERE d_dumpid='$dumpid'")); 
 				$time = $result[0];
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT AVG(d_dumptime_length) FROM dump WHERE d_userid='$userid'"));
 				$avgtime = $result[0];
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT MAX(d_dumptime_length) FROM dump WHERE d_userid='$userid'"));
 				$longtime = $result[0];
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT MIN(d_dumptime_length) FROM dump WHERE d_userid='$userid'"));
 				$shorttime = $result[0];
 				
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
													
 				$result = mysqli_fetch_array(mysqli_query($link, "SELECT d_type from
													( 
													SELECT   d_type, COUNT(d_type) AS type_occurrence
													FROM     dump
													WHERE d_userid = '$userid'
													GROUP BY d_type
													ORDER BY type_occurrence ASC
													LIMIT    1 ) as counts"));
				$leasttype = $result[0];
 				
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
			<a class="icon icon-left-nav pull-left" href="/index.php" data-transition="slide-out"></a>
			<h1 class="title">Dump Completed</h1>
		</header>
		
		<div class="content">
			<div class="content-padded">
				<form action="/index.php">
						<button class="btn btn-primary btn-block" type="submit">Done</button>		
				</form>
			</div>
			<br>
			
			<h1 class="content-padded centered">Stats</h1>
			<div class="card">
				<ul class="table-view">
					<li class="table-view-cell recent" ><i>Duration:</i> <b><?php echo $start ?> to <?php echo $end ?></b></li>
					
					<li class="table-view-cell"><i>Total Time:</i> <b><?php echo $time ?> seconds</b></li>
					<li class="table-view-divider"></li>

					<li class="table-view-cell"><i>Average Dump Time:</i><br><b><?php echo $avgtime ?> seconds</b></li>
					<li class="table-view-divider"></li>
		
					<li class="table-view-cell"><i>Longest Dump:</i> <b><?php echo $longtime ?> seconds</b></li>
					<li class="table-view-divider"></li>

					<li class="table-view-cell"><i>Shortest Dump:</i> <b><?php echo $shorttime ?> seconds</b></li>
					<li class="table-view-divider"></li>
					
					<li class="table-view-cell recent"><i>Size:</i> <b><?php echo $size ?>/10</b></li>
					<li class="table-view-divider"></li>
					
					<li class="table-view-cell"><i>Average Size:</i> <b><?php echo $avgsize ?>/10</b></li>
					<li class="table-view-divider"></li>

					<li class="table-view-cell"><i>Largest Dump:</i> <b><?php echo $bigsize ?>/10</b></li>
					<li class="table-view-divider"></li>

					<li class="table-view-cell"><i>Smallest Dump:</i> <b><?php echo $smallsize ?>/10</b></li>
					<li class="table-view-divider"></li>

					<li class="table-view-cell recent"><i>Type:</i> <b><?php echo $type ?></b></li>
					<li class="table-view-divider"></li>
					
					<li class="table-view-cell"><i>Most Common Type:</i> <b><?php echo $mosttype ?></b></li>
					<li class="table-view-divider"></li>

					<li class="table-view-cell"><i>Least Common Type:</i> <b><?php echo $leasttype ?></b></li>
					<li class="table-view-divider"></li>

					<li class="table-view-cell recent"><i>Color</i> <b><?php echo $color ?></b></li>
					<li class="table-view-divider"></li>

					<li class="table-view-cell"><i>Most Common Color</i> <b><?php echo $mostcolor ?></b></li>

				</ul>
			</div>
			<h1 class="content-padded centered">Charts</h1>
			<div class="card">
				<ul class="table-view">
					<li class="table-view-cell">Size vs. Time Taken</li>
					<li class="table-view-cell">
						<img src="/images/turdle.png" title="Turdle" style="display: block;margin-left: auto;margin-right: auto;width:65%">
					</li>
					<li class="table-view-divider"></li>

					<li class="table-view-cell">Most Common Color</li>
					<li class="table-view-cell">
						<img src="/images/turdle.png" title="Turdle" style="display: block;margin-left: auto;margin-right: auto;width:65%">
					</li>					<li class="table-view-divider"></li>

					<li class="table-view-cell">Turd Type over time</li>
					<li class="table-view-cell">
						<img src="/images/turdle.png" title="Turdle" style="display: block;margin-left: auto;margin-right: auto;width:65%">
					</li>
				</ul>
			</div>

	</body>
</html>
