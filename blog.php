<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<!--
	20150712 Hugo Hornquist

	Markup<?php /*and php*/ ?> for my personal blogg
	-->
	<?php
		//error_reporting(E_ALL);
		//ini_set('display_errors', '1');
		ini_set('display_startup_errors', 1);
		ini_set('display_errors', 1);
		error_reporting(-1);
		
		//debug items
		//echo exec('whoami');
		//echo('<br>');

		require('Parsedown.php');
		require('ParsedownExtra.php');
		
		require('nav-bar.php');
		require('month-to-string.php');
		require('content-strings.php');
		echo('<link rel="stylesheet" href="' . getString('rootDir') . '/blog.css">');
	?>
	<title>
		<?php
			echo( getString('title') );
			
			// Check if the file exists and isn't a bad string
			$fileExists = file_exists("./entries/" . $filename);
			if(empty($filename)) { $fileExists = false; }
			if((substr($filename, 0, 1) === ".") ||
				 (substr($filename, 0, 1) === "/")) { 
					$fileExists = false; 
			}

			if($fileExists) {
				$file_array = file("./entries/" . $filename );
				if(substr($file_array[0], 0, 1) === "#") {
					$title = $file_array[0];
					unset($file_array[0]);
					echo(" | " . substr($title, 1, strlen($title)));
				}
			}
		?>
	</title>
</head>
<body>
<div id="all">
	<div id="top-bar">
		<?php 
			echo('<h1>' . getString('header') . '</h1>');
			echo('<p>'  . getString('subHeader') . '</p>');
		?>
	</div>
	<div id="nav-pane">
		<?php
			/*
			 * The /a/ is a dummy string, since the nav info is always in 'block' 2.
			 */
			echo("<a class='back' href='" . getUrl('first') . "'>|&lt;</a>");
			echo("<a class='back' href='" . getUrlFilename( "prev", $filename ) . "'>Föregående</a>");
			if($filename === 'list'     ||
			   $filename==='about.md'   ||
			   $filename==='contact.md' ||
			   $filename==='legal.md'   || 
			   $filename==='qna.md'
			   ) {
				echo("<a href='" . getUrl("latest") . "'>Nuvarande inlägg</a>");
			} else {
				echo("<a href='" . getUrl("list") . "'>Lista</a>");
			}
			echo("<a class='fwd' href='" . getUrlFilename( "next", $filename ) . "'>Nästa</a>");
			echo("<a class='fwd' href='" . getUrl("latest") . "'>&gt;|</a>");
		?>
	</div>
	 <div id="content">
		<?php

			$Pd = new parsedownExtra();
			
			if($filename==='about.md'   ||
			   $filename==='contact.md' ||
			   $filename==='legal.md'   || 
			   $filename==='qna.md') {
				$file = './footnote/' . $filename;
				echo $Pd->text(file_get_contents($file));
			} elseif($filename==='list') {
				echo("<div id='list'><table><tr><th class='tableLeft'>Date</th><th class='tableRight'>Name</th></tr>");
				for($i = count($entries) - 1; $i >= 0; $i--) {
					$name = substr($entries[$i], 10);
					if(is_numeric(substr($name, 0, 6))) {
						echo(
							"<tr><td class='tableLeft'>
							<a href='/blogg/" . 
							$name . "'>" . 
							substr($name, 6, 2) . " " . 
							getMonth(substr($name, 4, 2)) . " ". 
							substr($name, 0, 4) . "</a>" .  
							"</td>
							<td class='tableRight'>
							<a href='/blogg/" . 
							$name . "'>" . 
							substr($name, 8, strlen($name) - 11) . "</a>
							</td></tr>"
						);
					} else {
						echo(
							"<tr><td class='tableLeft'></td><td class='tableRight'>
							<a href='/blogg/" .
							$name . "'>" . $name . "</a>
							</td></tr>"
						);
					}
				}
				echo('</table></div>');
			} elseif($fileExists) {
				if(true): ?>
					<div class=wrapper>
					<div id=entryHeader>
				<?php endif;
				if(isset($title)) {
					echo $Pd->text($title);
				}
				if(true): ?>
					</div> <!-- entryHeader -->
					<div id=dateTag>
				<?php endif;
					if($fileExists) {
						$name = $filename;
					}
					if(is_numeric(substr($name, 0, 6))) {
						echo(
							"<p>" . getString('author') . ", " . 
							substr($name, 6, 2) . " " . 
							getMonth(substr($name, 4, 2)) . " ". 
							substr($name, 0, 4) . "</p>"
						);
					} else {
						echo('<p>' . getString('author') . '</p>');
					}
				if(true): ?>
					</div> <!-- dateTag -->
					</div> <!-- wrapper -->
					<div id=entryBody>
				<?php endif;
					echo $Pd->text(implode("", $file_array));
				if(true): ?>
					</div> <!-- entryBody -->
				<?php endif;
			} else {
				if(true): ?>
					<p class=missingFileHeader>No such file exists!</p>
					<p class=missingFileText>
					There is no blog entry (or other file) with that name on 
					the server. Please try another file.
					</p>
				<?php endif;
			}
		?>
	</div> <!-- Content -->
	<?php
	/*Add files here if they shouldn't have a comment section.*/
	 if(!(
		!$fileExists                ||
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
		<?php
			echo('<a href="' . getUrlFilename( "regular", "about.md"   ) . '">About</a>'  );
			echo('<a href="' . getUrlFilename( "regular", "contact.md" ) . '">Contact</a>');
			echo('<a href="' . getUrlFilename( "regular", "legal.md"   ) . '">Legal</a>'  );
			echo('<a href="' . getUrlFilename( "regular", "qna.md"     ) . '">Q&amp;A</a>');
		?>

	</div>
</div>
</body>
</html>
