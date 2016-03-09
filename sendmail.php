<?php

$to = 'yuri.santos@gmail.com';

$subject = 'Website Change Reqest';

$headers = "From: webmaster@oceanic.com\r\n";
$headers .= "Reply-To: webmaster@oceanic.com\r\n";
// $headers .= "CC: susan@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";

$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


$message = '<html><body>';
$message .= '<h1>Hello, World!</h1>';
$message .= '</body></html>';


mail($to, $subject, $message, $headers);

?>
