<?php
	/*
	 * 20150712 Hugo Hornquist
	 *
	 * Php 'libary' to handle the file sorting as well as the buttens
	 * on the nav-bar on the website.
	 * 
	 *
	 * The '10' when getting filepaths is due to ./entries/<file>
	 */
	
	/*
	 * Loads the contents of ./entries/ into an array
	 */
	$entriesDir = './entries';
	foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($entriesDir)) as $fname)
	{
		// filter out "." and ".."
		if ($fname->isDir()) continue;
		if (substr($fname, strlen($fname) - 4, 4) === '.swp') continue;
		if (substr($fname, strlen($fname) - 1, 1) === '~') continue;
		if(substr($fname, strlen($entriesDir) + 1, 1) === '.') continue;
		
		$entries[] = $fname;
	}
	
	$noEntries = count($entries);
	
	/*
	 * Sorts the files
	 */
	natsort($entries);
	//$entries = array_reverse($entries);
	$entries = array_values($entries);


	/*
	 * Loads the variables from the url if they are present.
	 * they are then set to default values if not specified.
	 */
	if(isset($_GET['nav'])) {
		$nav = $_GET['nav'];
	} else  {
		$nav = 0;
	}

	if(isset($_GET['filename'])) {
		$filename = $_GET['filename'];
	} else {
		$filename = substr($entries[$noEntries - 1], 10);
	}
	

	/*
	 * Gets the index in the file array for the current file
	 */
	for($i = 0; $i < $noEntries; $i++) {
		//echo(substr($entries[$i], 10) . "|" .  $filename . "<br>");
		if(substr($entries[$i], 10) === $filename) {
			//echo("<br> is set <br><br>");
			$pathIndex = $i;
			break;
			//break here
		}
	}
	if(!(isset($pathIndex))) {
		//echo("<br> index not set<br>");
		$pathIndex = $noEntries - 1;
	}

	/*
	 * Sets the nav-buttons to grey if there isn't anything
	 * more reachable by pressing them
	 */
	if($pathIndex == $noEntries - 1 ||
	   $filename === 'list'         ||
	   $filename === 'about.md'     ||
	   $filename === 'contact.md'   ||
	   $filename === 'legal.md'     ||
	   $filename === 'qna.md'
	   ) : ?> 
	<style type='text/css'>
		.fwd {
			pointer-events: none;
			cursor: default;
			color: grey !important;
		}
	</style>
	<?php endif;	
	if($pathIndex == 0            ||
	   $filename === 'list'       ||
	   $filename === 'about.md'   ||
	   $filename === 'contact.md' ||
	   $filename === 'legal.md'   ||
	   $filename === 'qna.md'
	   ) : ?> 
	<style type='text/css'>
		.back {
			pointer-events: none;
			cursor: default;
			color: grey !important;
		}
	</style>
	<?php endif;	
	
	if($nav === 'first') {
		//header("Location: /blogg/" . substr($entries[0], 10) . "/");
		header("Location: " . getUrlFilename( "default", substr($entries[0], 10) ) );
		die();
		//$filename = substr($entries[0], 10);
	}
	if($nav === 'prev') {
		$pathIndex--;
		if($pathIndex < 0) {
			$pathIndex = 0;
		}
		//header("Location: /blogg/" . substr($entries[$pathIndex], 10) . "/");
		header("Location: " . getUrlFilename( "default", substr($entries[$pathIndex], 10) ) );
		die();
		//$filename = substr($entries[$pathIndex], 10);
	}
	//This function isn't used anymore, and should be removed
	//if($nav === 'list') {
	//	//$filename = 'list';
	//	header("Location: ./blog.php?filename=list");
	//	die();
	//}
	if($nav === 'next') {
		$pathIndex++;
		if($pathIndex >= $noEntries) {
			$pathIndex = $noEntries - 1;
		}
		//header("Location: /blogg/" . substr($entries[$pathIndex], 10) . "/");
		header("Location: " . getUrlFilename( "default", substr($entries[$pathIndex], 10) ) );
		die();
		//$filename = substr($entries[$pathIndex], 10);
	}
	if($nav === 'latest') {
		//header("Location: /blogg/" . substr($entries[$noEntries - 1], 10) . "/");
		header("Location: " . getUrlFilename( "default", substr($entries[$pathIndex], 10) ) );
		die();
		//$filename = substr($entries[$noEntries - 1], 10);
	}
	/*
	 * when navigating to ./blog.php without anything else
	 * forces the user to the direct link to the latest entry.
	 */
	if(!(isset($_GET['filename']))) {
		// header("Location: ./blog.php?filename=" . $filename);
		//header("Location: /blogg/" . $filename . "/");
		header("Location: " . getUrlFilename( "default",  $filename ) );
		die();
	}

?>
