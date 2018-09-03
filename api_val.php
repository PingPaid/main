<?php

function esAPI($mode=0,$x,$xyz=0) {
$x = preg_replace('~[\r\n]+~', '', $x);
$x = str_replace(array("\n", "\r"), '', $x);
$x=trim($x);
	global $eAPI;
	$api = $eAPI;
	if($mode==0) {		
		$fVAL = -1;
		$wait = true;
		$url = "";
			$ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 $get = curl_exec($ch);
 if(preg_match('/result\"\:\"\d+/i',$get)) {
	 preg_match_all('/result\"\:\"\d+/i',$get,$val);
	 $val = preg_replace('/.+\"/i',"",$val[0][0]);
	 preg_match_all('/\d+/i',$val,$vx);
	 $fVAL = round($vx[0][0]/1000000000000000000,8);
 } else {
	 $wait = false;
 }
 if($wait) {
	// echo "true";
	//if(($xyz%300)=0) {
//sleep(6);
	//}
	
 }
 return $fVAL;
	}
}

?>