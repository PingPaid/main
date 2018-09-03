<?php
function MODIFY_FX($file,$tag,$data) {

	
	global $id;
	global $live_mode;
	//if($live_mode==0) { return 0; }
	global $servername;
global $username;
global $password;
$conn = new mysqli(D_SERVER, D_USER,"","");
	$result = $conn->query("SELECT _user FROM XYZ WHERE _user = '".$file."'");
if($result->num_rows == 0) {


} else {

	echo "found record\n";

	$sql = "UPDATE FX SET $tag='$data' WHERE _user='".$file."'";

$sql1 = "UPDATE FX SET appid='fx2' WHERE _user='".$file."'";

if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE)    {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

}
mysqli_close($conn);

}


?>