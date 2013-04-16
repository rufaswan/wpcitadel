<?php
if ( isset($_POST['sendcdl']) )
{
	$to = 'rufaswan@gmail.com';
	$header = "From: " . $_POST['user_email']. "\r\n";
	$header.= "Reply-To: " . $_POST['user_email'];

	$sub = "[CDL2 Feedback] " . $_POST['subject'];
	$msg = $_POST['user_identity'] . " ( " .$_POST['siteurl']. " ) \r\n\r\n";
	$msg.= $_POST['message'];

	mail($to, $sub, $msg, $header);
}
header('Location: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TTB56UFR7WPMW');
