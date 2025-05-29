<?php
// Load PHPMailer dependencies using Composer's autoloader
require "vendor/autoload.php";

// Import PHPMailer classes into the current namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Create a new PHPMailer instance (true enables exceptions)
$mail = new PHPMailer(true);

// Uncomment to enable verbose SMTP debugging (for troubleshooting)
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

// Configure mailer to use SMTP
$mail->isSMTP();

// Specify Gmail's SMTP server
$mail->Host = 'smtp.gmail.com';

// Enable SMTP authentication
$mail->SMTPAuth = true;

// SMTP username (your Gmail address)
$mail->Username = 'zactubol@gmail.com'; // Your Gmail

// SMTP password (App Password if 2FA is enabled)
$mail->Password = 'hnjz kttg vxtz ccdf'; // Use App Password if 2FA enabled

// Enable TLS encryption (STARTTLS)
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

// TCP port to connect to (Gmail SMTP port for STARTTLS)
$mail->Port = 587;

// Set email format to HTML
$mail->isHTML(true);

// Return the configured mailer object
return $mail;

?>