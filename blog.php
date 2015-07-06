<!DOCTYPE HTML>
<meta charset="utf-8">
<html>
<link rel="stylesheet" href="./blog.css">
<head>
	<title>Blog</title>
</head>
<body>
<div id="all">
	<div id="top-bar">
		<h1><u>HugoNikanors blog‽</u></h1>
		<p>
		En blog om datorer; spel, programering & annat. Samt möjligen livet.
		</p>
	</div>
	<div id="nav-pane">
		<!--Replace with proper php-->
		<a href="./prev">Previous</a>
		<a href="./list">List</a>
		<a href="./next">Next</a>
	</div>
	<div id="content">
		<p>
		<?php
			readfile("entries/test1.md");
		?>
		</p>
	</div>
	<div id="footnote">
		<a href="./about">About</a>
		<a href="./contact">Contact</a>
		<a href="./legal">Legal</a>
		<a href="./other">Other</a>

	</div>
</div>
</body>
</html>
