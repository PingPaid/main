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


?>