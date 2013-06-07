<?php

$cp_page_template = '
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Presentation 2.0</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	{{{includes}}}
</head>

<body>
	<div id="header">
		<div id="header-content">
		{{{header}}}
		</div>
	</div>
	<div id="body">
		<div id="wrapper">
		{{{body}}}
		</div>
	</div>
<footer>
	<div id="footer-wrapper">
	<nav class="footer-nav">
	<a href="presentations_list.php">Home</a>
	{{{footer}}}
	</nav>
	<a href="https://github.com/deepsadhi/Presentation2.O" target="_blank">
		<img class="github" src="../images/github.png"/>
		<div id="title">Presentation 2.O</div>
	</a>
	</div>
</footer>

</body>
</html>
';
