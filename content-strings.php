<?php

	$staticStrings = array(
		"title" => "Hugos blogg",
		"header" => "<u>Hugonikanors blogg<span style='letter-spacing:-0.65em'>?!</span></u>",
		"subHeader" => "En blogg om datorer; spel, programmering & annat. Samt möjligen livet.",

		"navFirst"   => "|<",
		"navPrev"    => "Föregående",
		"navList"    => "Lista",
		"navCurrent" => "Nuvarande inlägg",
		"navNext"    => "Nästa",
		"navLast"    => ">|", 

		"author" => "Hugo Hornquist"
	);
	function getString($key) {
		if(isset($staticStrings[$key]) {
			return $staticStrings[$key];
		}
		else {
			throw new Exception('getString > no such value');
		}
	}

	$filepaths = array(
		"rootDir" => "/blogEngine"

	);
	function getPath($key) {
		if(isset($filePaths[$key]) {
			return $filePaths[$key];
		}
		else {
			throw new Exception('getPath > no such value');
		}
	}

	# urlMode: fancy / raw
	$urlMode = "fancy";

	$urlsRaw = array(

		"about"   => "./blog.php?filename=about.md",
		"contact" => "./blog.php?filename=contact.md",
		"legal"   => "./blog.php?filename=legal.md",
		"qna"     => "./blog.php?filename=qna.md",
	);

	$urlFancy = array(

		"about"   => "/blogg/about.md/",
		"contact" => "/blogg/contact.md/",
		"legal"   => "/blogg/legal.md/",
		"qna"     => "/blogg/qna.md/",
	);

	function getUrl($key) {
		if($urlMode === "fancy") {
			if(isset($urlFancy[$key]) {
				return $urlFancy[$key];
			}
			else {
				throw new Exception('getUrl > fancy > no such value');
			}
		} elseif( $urlMode === "raw" ) {
			if(isset($urlRaw[$key]) {
				return $urlRaw[$key];
			}
			else {
				throw new Exception('getUrl > raw > no such value');
			}
		} else {
			throw new Exception('getUrl > invalid url mode');
		}
	}

?>

