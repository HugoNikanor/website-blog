<!DOCTYPE HTML>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<!--
20150712 Hugo Hornquist

Website for my personal blog
-->
<html>
<head>
	<title>Blog</title>
	<link rel="stylesheet" href="./blog.css">
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
			echo("<a id='prev' href='./blog.php?filename=" . $filename . "&id=prev'>Previous</a>");
			if($filename === 'list') {
				echo("<a href='./blog.php'>Current entry</a>");
			} else {
				echo("<a href='./blog.php?id=list'>List</a>");
			}
			echo("<a id='next' href='./blog.php?filename=" . $filename . "&id=next'>Next</a>");
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
		<div id="disqus_thread"></div>
		<script type="text/javascript">
		    /* * * CONFIGURATION VARIABLES * * */
		    var disqus_shortname = 'hugonikanor';
		    
		    /* * * DON'T EDIT BELOW THIS LINE * * */
		    (function() {
			var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		    })();
		</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
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
