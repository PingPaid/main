<?php

function eth_push() {
	//create enough eth address for users in database, and push address
		global $servername;
	global $username;
	global $password;
	$index = 0;
		$conn = new mysqli(SERVER, LOGIN,PASS,"pingpaid_project");
	$result = $conn->query("SELECT user_id FROM XYZ WHERE _account_setup = 'TRUE'");
while($a = mysqli_fetch_array($result)){
$result_ = mysqli_query($conn,"SELECT user_id, ethid FROM XYZ WHERE user_id = '".$a['user_id']."'");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
}
$b = mysqli_fetch_row($result_);
//print_r($b);
$user =  clean_text($b[0]);
$ethid =  clean_text($b[1]);
if(preg_match("/DEFAULT/",$ethid)) {
	$index++;
}
}
if($index>0) {
create_eth_accounts($index,PASS);
pushethid(FILE_NAME,0,1); // push eth addresses
assign_eth();
}
}

?>