<!DOCTYPE HTML>
<meta charset="utf-8">
<html>
<!--
20150712 Hugo Hornquist

Website for my personal blog
-->
<link rel="stylesheet" href="./blog.css">
<head>
	<title>Blog</title>
	<?php
		error_reporting(E_ALL);
		ini_set('display_errors', '1');
		
		//debug items
		//echo exec('whoami');
		//echo('<br>');

		require('Parsedown.php');
		require('ParsedownExtra.php');
		
		require('nav-bar.php');
	?>
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
		<?php
			echo("<a href='./blog.php?id=first'>|<</a>");
			echo("<a href='./blog.php?filename=" . $filename . "&id=prev'>Previous</a>");
			echo("<a href='./blog.php?id=list'>List</a>");
			echo("<a href='./blog.php?filename=" . $filename . "&id=next'>Next</a>");
			echo("<a href='./blog.php?id=latest'>>|</a>");
		?>
	</div>
	<div id="content">
		<p>
		<?php

			$Pd = new parsedownExtra();
			//$pd = new parsedown();
			
			if($filename==='about.md'   ||
			   $filename==='contact.md' ||
			   $filename==='legal.md'   || 
			   $filename==='qna.md') {
				$file = 'footnote/' . $filename;
				echo $Pd->text(file_get_contents($file));
			} elseif($filename==='list') {
				for($i = count($entries) - 1; $i >= 0; $i--) {
				$name = substr($entries[$i], 10);
					echo("<a href='./blog.php?filename=" .
					      $name . "'>" . $name . "<a><br>");
				}
			} else {
				$file = 'entries/' . $filename;
				echo $Pd->text(file_get_contents($file));
			}
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
