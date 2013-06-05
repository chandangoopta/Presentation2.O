<?php

$cp_page_template = '

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8" />
	<title>Presentation 2.0</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	{{{includes}}}
</head>

<body>
	<div id="header">
		<div id="header-content">
		Presentation 2.O
		</div>
	</div>
	<div id="wrapper">
		<div id="slider">
			<div id="slider-wrapper">
				<div id="slider-container">
					<section class="slider-content active">
						<div id="content">
							{{{body}}}
						</div>
						<div id="p-header">
							
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
	<footer>
		{{{footer}}} | <a href="presentations_list.php">Home</a> | <a href="presentation.php">Resume</a>
	</footer>
</body>

</html>
';
