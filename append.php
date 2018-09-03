<?php

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