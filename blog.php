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
		En blog om datorer; spel, programmering & annat. Samt möjligen livet.
		</p>
	</div>
	<div id="nav-pane">
		<!--Replace with proper php-->
		<a href="./blog.php?id=first">|<</a>
		<a href="./blog.php?id=prev">Previous</a>
		<a href="./blog.php?id=list">List</a>
		<a href="./blog.php?id=next">Next</a>
		<a href="./blog.php?id=latest">>|</a>
	</div>
	<div id="content">
		<p>
		<?php
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
			
			require('Parsedown.php');
			require('ParsedownExtra.php');
		
			require('nav-bar.php');

			$Pd = new parsedownExtra();
			//$pd = new parsedown();
			$filename = $_GET['filename'];
			if($filename==='about.md'  ||
			   $filename==='contact.md' ||
			   $filename==='legal.md'   || 
			   $filename==='qna.md') {
				$path = 'footnote/' . $filename;
			} else {
				$path = 'entries/' . $filename;
			}
			echo $Pd->text(file_get_contents($path));
		?>
		</p>
	</div>
	<div id="comment">
		
	</div>
	<div id="footnote">
		<a href="./blog.php?filename=about.md">About</a>
		<a href="./blog.php?filename=contact.md">Contact</a>
		<a href="./blog.php?filename=legal.md">Legal</a>
		<a href="./blog.php?filename=qna.md">Q&A</a>

	</div>
</div>
</body>
</html>
