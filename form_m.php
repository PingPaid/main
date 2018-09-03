<?php




function link_craft($url,$array,$lh="link",$text="") {
	global $fname;
	global $actual_link;

	
	
	$xu = strtolower($url);
	if($xu=="script") {
		
		$url = $fname;
		
		
		
	}
	
		if($xu=="url") {
		
		$url = $actual_link;
		
		
		
	}
	
	if(!empty($array)) {
		$x = array();
		$s = "?xyz=0";
		foreach($array as $n) {
			$x[] = $n;
		}
		foreach($x as $i => $v) {
			$i = ($i+1);
			$s = $s."&g$i=$v";
		}
		//echo $s."<BR>";
		$url = $url.$s;
	}
	if(strtolower($lh)=="link") {
	return $url;	
	}
if(strtolower($lh)=="html") {
if(strlen($text)<3) { $text = $url; }
$url = "<A HREF=\""."$url"."\" target=\"_blank\" >$text</A>";
return $url;
	}
	//script
	//url
	//http://xyz
	//link,html
}





function form_craft($file) {
	global $ANNOTATIONS;
	
	
	$vault = array();
	
	
	$ex = explode("\n",$ANNOTATIONS);
	foreach($ex as $xe) {
		
		if(strlen($xe)>=2) { $vault[] = $xe; }
		
	}
	$x_ = 0;
	
	
	
	//global $_GET;
	//$set = array();
	//foreach($_GET as $k) { $set[] = $k; }
$e = explode("\n",$file);
$title = $e[0];
//echo $title."<BR>";
unset($e[0]);
$id = "blank";
$xs = explode(" ",$title);
$form_name = $xs[0];
$form__url = $xs[1];
$html = array();
$html[] = "<form name=\"$form_name\" id=\"$form_name\" action=\"$form__url\" method=\"post\" enctype=\"multipart/form-data\">";
foreach($e as $kn => $x2) {
if(strlen($x2)>2) {
	$id = $form_name."_$kn";
preg_match_all('/\S+/i',$x2,$x3);
$a = $x3[0][0];
$key_ = "";
$main = "";
if(preg_match("/textarea/i",$a)) {
if(isset($vault[$x_])) { $key_ = $vault[$x_]; $x_++; $main = $key_."<BR>"; }
	$main = $main."<textarea rows=\"w\" cols=\"h\" id=\"$id\" name=\"$id\">value</textarea>";
}
if(preg_match("/textfield/i",$a)) {
	if(isset($vault[$x_])) { $key_ = $vault[$x_]; $x_++; $main = $key_."<BR>"; }

	$main = $main."<input type=\"text\" name=\"$id\" id=\"$id\" value=\"value\">";
}
if(preg_match("/hidden/i",$a)) {
	$main = "<input type=\"hidden\" name=\"$id\" id=\"$id\" value=\"value\">";
}
if(preg_match("/submit/i",$a)) {
	$main = "<input type=\"submit\" value=\"Submit\">";
}
if(preg_match("/upload/i",$a)) {
	if(isset($vault[$x_])) { $key_ = $vault[$x_]; $x_++; $main = $key_."<BR>"; }

	$main = $main."<input type=\"file\" name=\"$id\" id=\"$id\"  >";
}
if(preg_match("/password/i",$a)) {
	if(isset($vault[$x_])) { $key_ = $vault[$x_]; $x_++; $main = $key_."<BR>"; }

	$main = $main."<input type=\"password\" name=\"$id\" id=\"$id\" value=\"value\">";
}
if(count($x3[0])==3) {
$a = $x3[0][0];
$b = $x3[0][1];
$c = $x3[0][2];
$c = urldecode($c);
$b = explode(",",$b);
foreach($b as $z) {
	$y = explode(":",$z);
	$y1 = $y[0];
	$y2 = $y[1];
$main = preg_replace("/\"$y1\"/i",'"'.$y2.'"',$main);	
$main = preg_replace('/value/i',$c,$main);	
	//echo $z."<BR>";
}
//form type, type qualities, pre-fill value	
} elseif(count($x3[0])==2) { 
$a = $x3[0][0];
$b = $x3[0][1];
$b = urldecode($b);
$main = preg_replace('/\"value\"/i',"\"".$b."\"",$main);
$main = preg_replace('/\>value\</i',">$b<",$main);	
	
} else {
$a = $x3[0][0];
$main = preg_replace('/\"value\"/i',"\"\"",$main);	
}
$html[] = $main;
}
}
$html[] = "</form>";
foreach($html as $h) {
	echo $h."<BR>\n";
}


if(strlen($ANNOTATIONS)>3) {
	
	$ANNOTATIONS = "";
	
	
}


return $html;
}


?>