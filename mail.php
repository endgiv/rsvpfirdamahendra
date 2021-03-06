<?php

/**
 * This example shows sending a message using PHP's mail() function.
 */

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Get Data From RSVP
include 'config.php';
// menangkap data yang di kirim dari form
$name = $_POST['name'];
$email = $_POST['email'];
$wish = $_POST['wish'];
$attend = $_POST['attend'];
$sesi = substr($_POST['sesi'], -1);




//Create a new PHPMailer instance
$mail = new PHPMailer();
//Set who the message is to be sent from
$mail->setFrom('no-reply@endgiv.com', 'endgiv');
//Set an alternative reply-to address
$mail->addReplyTo('hallo@endgiv.com', 'Hallo endgiv!');
//Set who the message is to be sent to
$mail->addAddress($email, $name);
//Set the subject line
$mail->Subject = 'Confirmation';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('mail_templates/mail_confirm.html'), __DIR__);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}
