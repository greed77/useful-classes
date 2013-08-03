<?php
require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstracts' . DIRECTORY_SEPARATOR . 'class-greed77-base.php' );

/**
 * TO-DO:
 * -headers to work with outlook
 * -text / html content
 * -template files
 * -attachments
 * -validate email address
 * -smtp
 * -error emails
 */

class Greed77_Mail extends Greed77_Base
{
  $to = '';
	$to_name = '';

	$from = '';
	$from_name = '';

	$subject = '';

	$content = '';

	$headers = array();

	function __construct()
	{
	}

	function send()
	{
		// // To send HTML mail, the Content-type header must be set
		// $headers  = 'MIME-Version: 1.0' . "\r\n";
		// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// // Additional headers
		// $headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
		// $headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
		// $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
		// $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

		// // Mail it
		// mail($this->to, $subject, $message, $headers);
	}

	function add_header( $header_text = '' )
	{
		if ( trim( $header ) <> '' ) {
			$this->headers[] = $header_text;
		}
	}

}
