<?php

function close_trade()  {
	global $EXCHANGE_ID;
	global $GLOBAL_ID;
	
	
	
		$count = array();
$cr = fopen($GLOBAL_ID."log.txt","r");
$ca = fread($cr,filesize($GLOBAL_ID."log.txt"));
fclose($cr);
$e = explode("\n",$ca);
shuffle($e);



foreach($e as $x) {
	//echo $x."\n\n";
	if(strlen($x)>4) {
	preg_match_all('/\S+/i',$x,$fid);
	$fid = $fid[0][0];
	//echo $fid."\n";
	//	if(!isset($count[$fid])) {
		//$count[$fid][0] = 0;
		//$count[$fid][1] = 0;
	//}
	if(preg_match('/\S+\s+\S+\s+OPEN/i',$x)) {
	preg_match_all('/\S+\s+\S+\s+OPEN/i',$x,$OP);
	$OP = $OP[0][0];
	//$count[$fid][0] = ($count[$fid][0])+1;
	$close = preg_replace("/OPEN/i","CLOSE",$OP);
	$close = preg_replace('/\//i',"\/",$close);
	
	
	if(preg_match("/$close/i",$ca)) {
			//$count[$fid][1] = ($count[$fid][1]+1);
	} else {
		$count[] = $x;
	}
	//echo $close."\n";
	}
	}
}
//	print_r($count);
	foreach($count as $x) {
		echo $x." key\n";
		$info = info($x);
		//$EXCHANGE_ID = $info[1];
		
		//print_r($info);
		if($EXCHANGE_ID==$info[1]) {
		close_out($info);
		}
		
	}
}



?>