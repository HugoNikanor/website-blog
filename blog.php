<!DOCTYPE HTML>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<html>
<head>
<!--
20150712 Hugo Hornquist

Markup<?php "and php" ?> for my personal blog
-->
	<title>Hugos blog</title>
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
		require('other.php');
	?>
</head>
<body>
<div id="all">
	<div id="top-bar">
	<h1><u>HugoNikanors blog</u><u style="letter-spacing:-0.65em">?!</u></h1>
		<p>
		En blog om datorer; spel, programmering & annat. Samt möjligen livet.
		</p>
	</div>
	<div id="nav-pane">
		<?php
			echo("<a class='back' href='./blog.php?id=first'>|&lt;</a>");
			echo("<a class='back' href='./blog.php?filename=" . $filename . "&amp;id=prev'>Föregående</a>");
			if($filename === 'list'     ||
			   $filename==='about.md'   ||
			   $filename==='contact.md' ||
			   $filename==='legal.md'   || 
			   $filename==='qna.md'
			   ) {
				echo("<a href='./blog.php'>Nuvarande inlägg</a>");
			} else {
				echo("<a href='./blog.php?id=list'>Lista</a>");
			}
			echo("<a class='fwd' href='./blog.php?filename=" . $filename . "&amp;id=next'>Nästa</a>");
			echo("<a class='fwd' href='./blog.php?id=latest'>&gt;|</a>");
		?>
	</div>
	<div id="content">
		<?php

			$Pd = new parsedownExtra();
			
			if($filename==='about.md'   ||
			   $filename==='contact.md' ||
			   $filename==='legal.md'   || 
			   $filename==='qna.md') {
				$file = 'footnote/' . $filename;
				echo $Pd->text(file_get_contents($file));
			} elseif($filename==='list') {
				echo("<div id='list'><table><tr><th>Date</th><th>Name</th></tr>");
				for($i = count($entries) - 1; $i >= 0; $i--) {
					$name = substr($entries[$i], 10);
					if(is_numeric(substr($name, 0, 6))) {
						echo(
							"<tr><td>
							<a href='./blog.php?filename=" . 
							$name . "'>" . 
							substr($name, 6, 2) . " " . 
							getMonth(substr($name, 4, 2)) . " ". 
							substr($name, 0, 4) . "</a>" .  
							"</td>
							<td>
							<a href='./blog.php?filename=" . 
							$name . "'>" . 
							substr($name, 8, strlen($name) - 11) . "</a>
							</td></tr>"
						);
					} else {
						echo(
							"<tr><td></td><td>
							<a href='./blog.php?filename=" .
							$name . "'>" . $name . "</a>
							</td></tr>"
						);
					}
				}
				echo('</table></div>');
			} else {
				$file = 'entries/' . $filename;
				echo $Pd->text(file_get_contents($file));
			}
		?>
	</div>
	<!--Add files here if they shouldn't have a comment section.-->
	<?php if(!(
		!(isset($_GET['filename'])) ||
		$filename === 'list'        ||
		$filename === 'about.md'    ||
		$filename === 'contact.md'  ||
		$filename === 'legal.md'    ||
		$filename === 'qna.md'
	)) : ?>
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
		<noscript>
			<hr>
			<p><b>Please enable JavaScrpt if you desire to see the <em>wonderful</em> comments.</b></p>
		</noscript> <!-- Sorry Disqus -->
	</div>
	<?php endif; ?>
	<div id="footnote">
		<a href="./blog.php?filename=about.md">About</a>
		<a href="./blog.php?filename=contact.md">Contact</a>
		<a href="./blog.php?filename=legal.md">Legal</a>
		<a href="./blog.php?filename=qna.md">Q&amp;A</a>

	</div>
</div>
</body>
</html>
