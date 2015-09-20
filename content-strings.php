<?php

	//$strings = parse_ini_file('content-strings.ini');
	//$urls    = parse_ini_file('urls.ini', true);

	function getString($key) {
		$strings = parse_ini_file('content-strings.ini');
		if(isset($strings[$key])) {
			return $strings[$key];
		}
		else {
			throw new Exception('getString > no such value');
		}
	}

	function getUrl( $key ) {
		$urls = parse_ini_file('urls.ini', true);
		if( isset( $urls["urlStyle"] ) ) {
			if(isset($urls[ $urls["urlStyle"] ][$key])) {
				return $urls[ $urls["urlStyle"] ]["urlPreceed"] . $urls[ $urls["urlStyle"] ][$key];
			}
			else {
				throw new Exception('getUrl > no such value');
			}
		} else {
			throw new Exception('getUrl > url mode not set');
		}
	}

	function getUrlFilename( $type, $filename ) {
		$urls = parse_ini_file('urls.ini', true);
		if( isset( $urls["urlStyle"] ) ) {
				$returnString = $urls[ $urls["urlStyle"] ]["urlPreceed"] . $urls[ $urls["urlStyle"] ]["entry"] . $filename;
				if( $type === "prev" ) {
					$returnString .= $urls[ $urls["urlStyle"] ]["prev"];
				}
				if( $type === "next" ) {
					$returnString .= $urls[ $urls["urlStyle"] ]["next"];
				}
				return $returnString;
		} else {
			throw new Exception('getUrlFilename > url mode not set');
		}
	}

?>

