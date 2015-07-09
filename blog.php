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
		<a href="./first">|<</a>
		<a href="./prev">Previous</a>
		<a href="./list">List</a>
		<a href="./next">Next</a>
		<a href="./latest">>|</a>
	</div>
	<div id="content">
		<p>
		<?php
			require('./Parsedown.php');
			$Pd = new Parsedown();
			$filename = $_GET['filename'];
			if($filename==='about.md'  ||
			   $filename==='contact.md' ||
			   $filename==='legal.md'   || 
			   $filename==='qna.md') {
				echo($filename);
				echo $Pd->text('---');
				echo $Pd->text(file_get_contents($filename));
			} else {
				$path = 'entries/' . $filename;
				echo($path);
				echo $Pd->text('---');
				try {
					//echo $Pd->text(file_get_contents($path));
					//echo $Pd->text(file_get_contents("entries/code.md");
				} catch (Exception $e) {
					echo 'Exception: ', $e->getMessage(), "\n";
				}
			}
			echo $Pd->text('---');
			$fname = "code.md";
			echo($fname);
			echo $Pd->text(file_get_contents($fname));
			echo $Pd->text(file_get_contents($filename));
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
