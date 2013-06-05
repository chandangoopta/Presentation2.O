<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require_once('includes'.DS.'init.inc.php');
require_once(LIB_PATH.DS.'authenticate.inc.php');
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8" />
	<title>Presentation 2.0</title>
	<meta name="viewport" content="width=device-width; initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<script src="inc.js"></script>
	<script src="../js/jquery-2.0.0.min.js"></script>
</head>

<body>
	<div id="header">
		<div id="header-content">
		Presentation 2.O
		</div>
	</div>

	<div id="body">
		<div id="wrapper">
			<div id="slider">
				<div id="slider-wrapper">
					<div id="slider-container">
						<section class="slider-content active">
							<div id="content">
								<input type="button" value="<<Prev" onmouseup="slide_action(0)">
								<input type="button" value="Next>>" onmouseup="slide_action(1)">
							</div>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<div id="footer-wrapper">
		<a href="presentations_list.php">Home</a> | <a href="presentation.php">Resume</a>
		</div>
	</footer>
</body>

</html>
