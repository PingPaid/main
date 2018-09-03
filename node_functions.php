<?php

function node_extract($node,$stream) {
//echo $stream."<BR>";
$stop = 0;
$end = 0;
$content = NULL;
$l = explode("\n",$stream);
$first = NULL;
$last = NULL;
foreach($l as $k => $v) {
if($stop==0 && preg_match("/\<$node\>/i",$v)) {
$first = $k;
$stop++;
}
if($end==0 && $k > $first && preg_match("/\<\/$node\>/i",$v) ) {
$last = $k;
$end++;
}
}
//echo $first."< | >".$last." $node<BR>";
for($i = ($first+1); $i < $last; $i++) {
if($content==NULL) { $content = $l[$i]; } else {
$content = $content."\n".$l[$i]; }
//echo $i." bb $node<BR>";
}
///echo $content." content<BR>";
return $content;
}

function modAll($cID,$tag,$file,$content,$tight=0) {
$stream = fopen($file,"r");
$sr = fread($stream,filesize($file));
fclose($stream);
$np = explode("\n",$sr);
$stop =0;
$lp = NULL;
foreach($np as $n => $p) {
if(preg_match("/\<$tag\>/i",$p)) {
$lp = $n;
$stop++;
}
if($stop==$cID && $n==$lp) {
//echo "gotcha\n";
$pl = 0;
//echo $pl." ".$n."\n";
for($k = $n; $k < count($np); $k++) {
if($pl==0) {
$dm = $np[$k];
//echo $dm."\n";
if(preg_match("/\<\/$tag\>/i",$dm)) {
//echo "no1 $k"."\n";
if(($k-$n)==1) {
//echo "true $k<BR>";
$np[$k] = "$content\n</$tag>";
//it is empty, put something there
} else {
for($l=($n+1); $l < $k; $l++) {
//echo $l." el<BR>";
$xt = ($k-$n)-1;
$xt = ($k-$xt);
//echo $xt." $k\n";
if($xt==$l) {
//echo "bing\n";
$np[$l] = $content;
} else {
unset($np[$l]);
}
}
}
$pl++;
}
}
}
}
//echo $stop." ".$n." ".$p."\n";
}
$ww = fopen($file,"w");
fwrite($ww,"");
fclose($ww);
$rf = fopen($file,"a");
foreach($np as $nt => $xn) {
//echo $xn."\n";
if(intval($nt) != count($np)-1) {
fwrite($rf,$xn."\n");
} else {
//if($np[($nt-1)]==" " && $np[($nt-2)]==" " && $np[($nt-3)]==" ") { } else {
fwrite($rf,"\n");
//}
}
}
for($il = 0; $il < 2; $il++) {
fwrite($rf,"\n");
}
fclose($rf);
$stream = fopen($file,"r");
$sr = fread($stream,filesize($file));
fclose($stream);
$np = explode("\n",$sr);
$rn2 = $np; $end = 0;
foreach($rn2 as $x => $y) {
//if($y=="\n" &&  $rn2[($x-1)]=="\n" && $rn2[($x-2)]=="\n") { $end = $x; }
if(isset($rn2[($x-1)]) && isset($rn2[($x-2)])) {
if(!preg_match('/.../i',$y) && !preg_match('/.../i',$rn2[($x-1)]) && !preg_match('/.../i',$rn2[($x-2)])) {
$end = $x;
}
}
}
$lo = 0;
for($b = $end; $b >= 0; $b--) {
$y = $rn2[($b)];
if(preg_match('/./i',$y) && $lo==0) {
$end = $b;
$lo++;
}
}
$end++;
$end = ($end+7);
if($tight==1) {
echo $end." END<BR>";
$ww = fopen($file,"w");
fwrite($ww,"");
fclose($ww);
$rf = fopen($file,"a");
if($end>0) { 
for($v= 0; $v < $end; $v++) {
$xn = $rn2[$v];
fwrite($rf,$xn."\n");
}
}
fclose($rf);
}
}

function sappend($file,$s) {
if(!file_exists($file)) {
$fw=fopen($file,"w");
fwrite($fw,$s);
fclose($fw);
} else {
$fo=fopen($file,"a");
fwrite($fo,$s);
fclose($fo);
}
}

?>