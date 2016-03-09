<?php

// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );

@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';
require_once 'tools/tools.php';
require_once 'tools/notifications.php';

$conn = connect();
$org_id = 1;
$level = 'SUPERVISOR';
$alerts = new EmailSystem($conn, $org_id, $level);
$users = $alerts->getHigherDetails();
for($i=0; $i<=count($users); $i++)
{
	echo "Username: " . $users['users'][$i]['username'] . "<br>";
	echo "Email: " . $users['users'][$i]['email'] . "<br>";
	
	$ot_start = 'Jan 20, 2016';
	$total_hours = 10;
	$employee_id = 1;
	$reason = 'test reason';
	$output = 'test output';
	
	$message = "You have a pending Overtime for Approval";
	// send email
	
	sendMail('yuri.santos@gmail.com', 'test', $message);
}

function sendMail($to, $subject, $message)
{
	$to = 'yuri.santos@gmail.com';

	$subject = 'Website Change Reqest';

	$headers = "From: webmaster@oceanic.com\r\n";
	$headers .= "Reply-To: webmaster@oceanic.com\r\n";
	// $headers .= "CC: susan@example.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";

	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	/*
	$message = '<html><body>';
	$message .= '<h1>Hello, World!</h1>';
	$message .= '</body></html>';
	*/


	mail($to, $subject, $message, $headers);

}

?>