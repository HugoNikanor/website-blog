<?php

	$strings = parse_ini_file('content-strings.ini');
	$urls    = parse_ini_file('urls.ini', true);

	function getString($key) {
		$strings = parse_ini_file('content-strings.ini');
		if(isset($strings[$key])) {
			return $strings[$key];
		}
		else {
			throw new Exception('getString > no such value');
		}
	}

	function getUrl($key) {
		if($urls["urlStyle"] === "fancy") {
			if(isset($urls["fancy"][$key])) {
				return $urls["fancy"][$key];
			}
			else {
				throw new Exception('getUrl > fancy > no such value');
			}
		} elseif( $urls["urlStyle"] === "raw" ) {
			if(isset($urls["raw"][$key])) {
				return $urls["raw"][$key];
			}
			else {
				throw new Exception('getUrl > raw > no such value');
			}
		} else {
			throw new Exception('getUrl > invalid url mode');
		}
	}

?>

