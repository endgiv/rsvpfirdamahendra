<?php 
// koneksi database
include 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'index.php';

$email_template = file_get_contents("mail_templates/mail_confirm.html");
 foreach(array_keys($swap_var) as $key){
    if(strlen($key) > 2 && trim($key) != "")
       $email_template = str_replace($key, $swap_var[$key], $email_template);
 }


// menangkap data yang di kirim dari form
$name = $_POST['name'];
$email = $_POST['email'];
$wish = $_POST['wish'];
$attend = $_POST['attend'];
$sesi = substr($_POST['sesi'], -1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //prepare insert
        $sql = "INSERT INTO rsvp (name, email, wish, attend, sesi) VALUES (?, ?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            //bind var
            mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $wish, $attend, $sesi);
            
            //
        }
        
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        //Set who the message is to be sent from
        $mail->setFrom('no-reply@endgiv.com', 'endgiv');
        //Set an alternative reply-to address
        $mail->addReplyTo('hallo@endgiv.com', 'Hallo endgiv!');
        //Set who the message is to be sent to
        $mail->addAddress($email, $name);
        //Set the subject line
        $mail->Subject = '[RSVP] The Wedding of '.$swap_var[WEDDING_NAME]; //Subject
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($email_template), __DIR__);
        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        // $mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send() && mysqli_stmt_execute($stmt)) {
            echo 'sent';
        } else {
            echo 'Error!';
        }


    }
?>