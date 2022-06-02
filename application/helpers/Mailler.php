<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include(__DIR__.'../../../../assets/mailler/vendor/autoload.php');
function create_phpmailer() {
	$mail 							= new PHPMailer;
	$mail->isSMTP();
	$mail->Debugoutput 		= 'html';
	$mail->Host 			= 'ssl://smtp.googlemail.com';
	$mail->Port 			=  465;
	$mail->SMTPSecure 		= 'tls';
	$mail->SMTPAuth 		=  true;
	$mail->Username 		= "m.satrion0501997@gmail.com";
	$mail->Password 		= "Akamsi123";
	$mail->setFrom('m.satrion0501997@gmail.com', 'Tour and Travel Yeka Mandira Palembang');
	return $mail;
}