<?php


function getKey($buffer) {
	if(preg_match('/buffer/i',$buffer)) {
		$buffer = preg_replace('/buffer/i',"",$buffer);
		$buffer = preg_replace('/\</i',"",$buffer);
		$buffer = preg_replace('/\>/i',"",$buffer);
		$buffer = preg_replace("/\s+/i","",$buffer);
	$x = $buffer;
	$x = preg_replace('~[\r\n]+~', '', $x);
$x = str_replace(array("\n", "\r"), '', $x);
$x=trim($x);
return $x;

	}
	
	return "";
}


?>