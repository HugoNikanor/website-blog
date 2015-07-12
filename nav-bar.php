<?php
	/*
	 * 20150712 Hugo Hornquist
	 *
	 * Php 'libary' to handle the file sorting as well as the buttens
	 * on the nav-bar on the website.
	 */
	
	/*
	 * Loads the contents of ./entries/ into an array
	 */
	foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./entries')) as $fname)
	{
		// filter out "." and ".."
		if ($fname->isDir()) continue;

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
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
	} else  {
		$id = 0;
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
	
	if($id === 'first') {
		header("Location: ./blog.php?filename=" . substr($entries[0], 10));
		die();
		//$filename = substr($entries[0], 10);
	}
	if($id === 'prev') {
		$pathIndex--;
		if($pathIndex < 0) {
			$pathIndex = 0;
		}
		header("Location: ./blog.php?filename=" . substr($entries[$pathIndex], 10));
		die();
		//$filename = substr($entries[$pathIndex], 10);
	}
	if($id === 'list') {
		//$filename = 'list';
		header("Location: ./blog.php?filename=list");
		die();

	}
	if($id === 'next') {
		$pathIndex++;
		if($pathIndex >= $noEntries) {
			$pathIndex = $noEntries - 1;
		}
		header("Location: ./blog.php?filename=" . substr($entries[$pathIndex], 10));
		die();
		//$filename = substr($entries[$pathIndex], 10);
	}
	if($id === 'latest') {
		header("Location: ./blog.php?filename=" . substr($entries[$noEntries - 1], 10));
		die();
		//$filename = substr($entries[$noEntries - 1], 10);
	}

?>
