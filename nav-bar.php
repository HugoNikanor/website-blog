<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');


	/*
	 * Id id is set in the url use it,
	 * else set it to 0 (null)
	 */
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
	} else  {
		$id = 0;
	}

	foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./entries')) as $filename)
	{
		// filter out "." and ".."
		if ($filename->isDir()) continue;

		$entries[] = $filename;
	}
	$noEntries = sizeof($entries);
	
	/*
	if(isset($_GET['entry'])) {
		$currentPath = $_GET['entry'];
		echo('set from above');
	} else  {
		$currentPath = $noEntries;
		echo('set from within');
	}
	*/


	natsort($entries);
	$entries = array_values($entries);

	for($i = 0; $i < sizeof($entries); $i++) {
		echo(substr($entries[$i], 10) . "|" .  $_GET['filename'] . "<br>");
		if(substr($entries[$i], 10) === $_GET['filename']) {
			echo("<br> is set <br>");
			$currentPath = $i;
		}
	}
	if(!(isset($currentPath))) {
		echo("<br> hello");
		$currentPath = sizeof($entries) - 1;
	}

	echo($currentPath);

	//echo("<br><br><script type='text/javascript'>alert(" . $currentPath . ");</script><br><br>");
	

	if($id === 'first') {
		//header("Location: //www.google.com");
		//die();
		//$path = $entries[0];
		header("Location: ./blog.php?filename=" . substr($entries[0], 10));
		die();
	}
	if($id === 'prev') {
		echo("<br><br><script type='text/javascript'>alert(" . $currentPath . ");</script><br><br>");
		$currentPath--;
		if($currentPath < 0) {
			$currentPath = 0;
		}
		//$path = $entries[$currentPath];
		//header("Location: ./blog.php?filename=" . substr($entries[$currentPath], 10) . "&entry=" . $currentPath);
		echo($currentPath);
		header("Location: ./blog.php?filename=" . substr($entries[$currentPath - 1], 10));
		die("dead");
	}
	if($id === 'list') {
		for($i = 0; $i < count($entries); $i++) {
			echo($entries[$i] . '<br>');
		}
	}
	if($id === 'next') {
		$currentPath++;
		if($currentPath >= $noEntries) {
			$currentPath = $noEntries - 1;
		}
		//header("Location: ./blog.php?filename=" . substr($entries[$currentPath], 10) . "&entry=" . $currentPath);
		header("Location: ./blog.php?filename=" . substr($entries[$currentPath], 10));
		
		//$path = $entries[$currentPath];
		
	}
	if($id === 'latest') {
		header("Location: ./blog.php?filename=" . substr($entries[$noEntries - 1], 10));
		die();
	}

?>
