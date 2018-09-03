<?php


function send_mail($group,$body_,$subject,$type=0,$info=array()) {
	$confirmation_email = "";
	$individual_email = "";
	$threshold_for_timeout = 750; //for every X email, wait X seconds
$timeout_wait = 30; //in seconds 
$smtp_host = '';
$smtp_port = '';
$smtp_username = '';
$smtp_password = '';
$tina = 1;
$FRUM = "";
$multi_thread_delimit = 300;
$multi_thread_wait = 480;
$mode_ = 0; // 0 = MULTI THREAD; 1 = NORMAL MODE, 2 = SMS mode
$kit = 1;
$session = 0;
$SMS_limit = 200;
$target = array();
$admin = array();
$admin[] = "";
$admin[] = "";
//0 - CONFIRMED USERS ONLY
//1 - CONFIRMATION EMAIL
//2 - INDIVIDUAL EMAIL
if($type==2) {
	
$sender = "";// Your name and email address
$recipient = "".$info[3]." <$group>"; // The Recipients name and email address
$subject = $subject;// Subject for the email
$text = $body_[0];
	$html = "<html><body>".$body_[1]."</body></html>";// HTML version of the email
$crlf = "\r\n";
$headers = array('From' => $sender, 'Return-Path' => $sender, 'Subject' => $subject);
// Creating the Mime message
$mime = new Mail_mime($crlf);
// Setting the body of the email
$mime->setTXTBody($text);
$mime->setHTMLBody($html);
$body = $mime->get();
$headers = $mime->headers($headers);
// Sending the email
$smtp = Mail::factory('smtp', array(
        'host' => $smtp_host,
        'port' => $smtp_port,
        'auth' => true,
        'username' => $smtp_username, //your  account
        'password' => $smtp_password // your password
		)
		);
$mail = $smtp->send($recipient, $headers, $body);
	
	/*
				$headers = array(
    'From' => $FRUM,
    'To' => $group,
    'Subject' => $subject
);
$smtp = Mail::factory('smtp', array(
        'host' => $smtp_host,
        'port' => $smtp_port,
        'auth' => true,
        'username' => $smtp_username, //your  account
        'password' => $smtp_password // your password
    ));
	$mail = "";
// Send the mail
$mail = $smtp->send($to, $headers, $individual_email);
echo $mail." $target\n";
if(preg_match('/(fail|error|unknown)/i',$mail)) {
	$tina = 1;
		sleep($timeout_wait);
}
*/
}
if($type==1) {
	//confirmation_email
$confirmation_email = "  ";

	
	
	
	
if(mailserver_exists($group)==1) {

	
	
	$sender = "";// Your name and email address
$recipient = "".$info[3]." <$group>"; // The Recipients name and email address
$subject = $subject;// Subject for the email
$text = 
"


";

// Text version of the email
$html = "<html><body>$confirmation_email</body></html>";// HTML version of the email
$crlf = "\r\n";
$headers = array('From' => $sender, 'Return-Path' => $sender, 'Subject' => $subject);
// Creating the Mime message
$mime = new Mail_mime($crlf);
// Setting the body of the email
$mime->setTXTBody($text);
$mime->setHTMLBody($html);
$body = $mime->get();
$headers = $mime->headers($headers);
// Sending the email
$smtp = Mail::factory('smtp', array(
        'host' => $smtp_host,
        'port' => $smtp_port,
        'auth' => true,
        'username' => $smtp_username, //your  account
        'password' => $smtp_password // your password
		)
		);
$mail = $smtp->send($recipient, $headers, $body);


	
	/*
			$headers = array(
    'From' => $FRUM,
    'To' => $group,
    'Subject' => $subject
);
$smtp = Mail::factory('smtp', array(
        'host' => $smtp_host,
        'port' => $smtp_port,
        'auth' => true,
        'username' => $smtp_username, //your  account
        'password' => $smtp_password // your password
    ));
	$mail = "";
// Send the mail
$mail = $smtp->send($group, $headers, $confirmation_email);
*/

//echo $mail." $target\n";





if(preg_match('/(fail|error|unknown)/i',$mail)) {
	$tina = 1;
		sleep($timeout_wait);
}
}
}
if($type==0) {
if($group=="ADMIN" or $group=="admin" ) {
foreach($admin as $a) { $target[1][] = $a; }
//echo "True\n";
} elseif($group=="ALL" || $group=="all")  {
				global $servername;
	global $username;
	//global $password;
	$conn = new mysqli($servername, $username,D_PASS,D_DBN);
if ($conn->connect_error ) {
return "";
}
$result = $conn->query("SELECT XXX FROM XXX WHERE acc_conf_status = 'XXX'");
while($a = mysqli_fetch_array($result)){
$result_ = mysqli_query($conn,"SELECT XXX, XXX, XXX, XXX, XXX FROM XXX WHERE XXX = '".$a['XXX']."'");
if (!$result) {
    //echo 'Could not run query: ' . mysql_error();
}
$b = mysqli_fetch_row($result_);
//print_r($b);
if(!in_array($b[0],$target[1])) {
$target[1][] =  $b[0];
$target[2][] = $b[2]; //username
$target[3][] = ucwords($b[3]); //Full Name
$target[4][] = $b[4]; //Eth addr
}
}
	foreach($admin as $a) {
if(!in_array($a,$target[1])) {		
	$target[1][] = $a;
}
	}
}
//$target = array_unique($target);
foreach($target[1] as $key => $tb) {
	$username = "";
	$full_name = "";
	$eth_address = "";
if(isset($target[2][$key])) {
$username = $target[2][$key]; 
}
if(isset($target[3][$key])) {
$full_name = $target[3][$key]; 
}
if(isset($target[4][$key])) {
$eth_address = $target[4][$key]; 
}

$sender = "";// Your name and email address
$recipient = "".$full_name." <$tb>"; // The Recipients name and email address
$subject = $subject;// Subject for the email
$text = $body_[0];
	$html = "<html><body>".$body_[1]."</body></html>";// HTML version of the email
$crlf = "\r\n";
$headers = array('From' => $sender, 'Return-Path' => $sender, 'Subject' => $subject);
// Creating the Mime message
$mime = new Mail_mime($crlf);
// Setting the body of the email
$mime->setTXTBody($text);
$mime->setHTMLBody($html);
$body = $mime->get();
$headers = $mime->headers($headers);
// Sending the email
$smtp = Mail::factory('smtp', array(
        'host' => $smtp_host,
        'port' => $smtp_port,
        'auth' => true,
        'username' => $smtp_username, //your  account
        'password' => $smtp_password // your password
		)
		);
$mail = $smtp->send($recipient, $headers, $body);

/*
	//echo $key." ".$tb."\n";
		$headers = array(
    'From' => $FRUM,
    'To' => $tb,
    'Subject' => $subject
);
$smtp = Mail::factory('smtp', array(
        'host' => $smtp_host,
        'port' => $smtp_port,
        'auth' => true,
        'username' => $smtp_username, //your  account
        'password' => $smtp_password // your password
    ));
	$mail = "";
// Send the mail
//$mail = $smtp->send($to, $headers, $body);
//echo $mail." $target\n";
if(preg_match('/(fail|error|unknown)/i',$mail)) {
	$tina = 1;
		sleep($timeout_wait);
}*/
}
}
}




?>