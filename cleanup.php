<?php



function deleteDir($path)
{
    return is_file($path) ?
            @unlink($path) :
            array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
}

$xo=fopen("file.txt","r");
$xo=fread($xo,filesize("file.txt"));
$xo=explode("\n",$xo);

if(file_exists("index.html")) {
unlink("index.html");
}

$dir = getcwd();


preg_match_all('/\w+/i',$dir,$d2);
$d3 = "http://localhost";
$start = 0;

foreach($d2[0] as $k => $dn) {

if(preg_match('/htdocs/i',$dn)) {

$start = $k; 

}

if($start>0 && $k>$start) {

$d3 = $d3."/$dn";

}

}

$xi=file_get_contents($d3);
preg_match_all('/\<a\s+href\=\"\S+\.\S+\"\>/i',$xi,$l);


$nv=array();
foreach($xo as $x) {
$x=trim($x);
$nv[]=$x;
//echo $x."<BR>";
}

foreach($l[0] as $x) {
//$x=htmlentities($x);//."<BR>";
$x=preg_replace('/\<a\s+href\=\"/i',"",$x);
$x=trim(preg_replace('/\"\>/i',"",$x));

if(preg_match('/\d+\_\d+\_\d+\_.+\.obj/i',$x)) { unlink($x); echo $x."\n"; }

if(!preg_match('/evolution/i',$x) && !preg_match('/config/i',$x) && !preg_match('/.+cache/i',$x) && !preg_match('/\w+cache\.txt/i',$x) && !preg_match('/\_brains\.txt/i',$x) && !preg_match('/\_brain\.txt/i',$x) && !preg_match('/\_lines\.txt/i',$x) && !preg_match('/\d+\_\d+\_\d+.+\.exe/i',$x) && !preg_match('/\S+\.lib/i',$x) && !preg_match('/\_top\.txt/i',$x) && !preg_match('/\d+cache\.txt/i',$x) && !preg_match('/dialect\_database\.txt/i',$x) && !preg_match('/\_dialect\.c/i',$x) && !preg_match('/\_dialect/i',$x) && !preg_match('/\d+\_\d+\_\d+\_menu.txt/i',$x) && !preg_match('/\d+\_\d+\_\d+\_stringt.txt/i',$x) && !preg_match('/\d+\_\d+\_strings\_t\.txt/i',$x) && !preg_match('/\d+\_\d+\_\d+\_\w+\.txt/i',$x) ) {
if(!preg_match('/raw\_cpb\.txt/i',$x)) {
if(!in_array($x,$nv)) {
if(!preg_match('/\S+\_white/i',$x) && !preg_match('/\S+\_wid/i',$x)) {
if(!preg_match('/\//i',$x)) {
	
	if(!preg_match('/tol\.txt/i',$x) && !preg_match('/\_SEQ/i',$x)  && !preg_match('/\_Sale/i',$x) ) {
	if(!preg_match('/\.proj/i',$x)) {
			if(!preg_match('/CONFIG/i',$x) && !preg_match('/pendx/i',$x) && !preg_match('/00\_/i',$x) ) {
	if(!preg_match('/\d+\_stacks/i',$x) && !preg_match('/\_log/i',$x)) {


echo $x." xl \n";
if(file_exists($x)) {
	
		if(!preg_match('/\_efx\.txt/i',$x) || preg_match('/multithread/i',$x)  ) {

unlink($x);

		}
		

}
}
}
}


}

}
}
}

}
}




}




$parc=strip_tags($xi);

preg_match_all('/\S+\//i',$parc,$ea);

foreach($ea[0] as $ex) {

$ex=strip_tags($ex);
$ex=preg_replace('/\//i',"",$ex);


if(in_array($ex,$nv)) {



} else {
echo $ex."\n";



if(!preg_match("/config/i",$ex)) {
deleteDir($ex);
}




}


//if(!empty($ex)) {
//rmdir($ex);
//}


}











?>