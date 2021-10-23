<?php 
// koneksi database
use Phppot\DataSource;
//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

require_once 'db\DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();


            

// menangkap data yang di kirim dari form
$name = $_POST['name'];
$email = $_POST['email'];
$wish = $_POST['wish'];
$attend = $_POST['attend'];
$session = substr($_POST['session'], -1);


$session_array = array(
    "1" => "11.00-12.00 WIB",
    "2" => "12.00-13.00 WIB",
    "3" => "13.00-14.30 WIB",
);
$session_h = $session_array[$session];
$swap_var = array(
    "{WEDDING_NAME}" => "Firda &amp; Mahendra",
    "{WEDDING_TO}" => $name,
    "{WEDDING_VENUE}" => "<br><b>Villa Nusantara Syariah, Malang</b>",
    "{WEDDING_LOCATION}" => "Jl. Argobimo No.29, Krajan, Ketindan, Kec. Lawang, Malang, Jawa Timur",
    "{WEDDING_ATTEND}" =>"<br><b>Attending</b><br>".$attend,
    "{WEDDING_SESSION}" =>"<br><b>Saturday, 06 November 2021</b>"."<br>".$session_h
);


$template_file ='./mail_templates/mail_confirm.html';
if(file_exists($template_file)){
    $email_message = file_get_contents($template_file);
    foreach(array_keys($swap_var) as $key){
        if(strlen($key) > 2 && trim($key) != "")
           $email_message = str_replace($key, $swap_var[$key], $email_message);
     }
}
else {
    die('unable to locate template');
}

$sqlSelect = "SELECT * FROM rsvp1 where name='$name' and session='$session'";
$result = $db->select($sqlSelect);
    if (! empty($result)) { 
        foreach($result as $row){
        $token = $row['token'];
        };
    }
    else {
        //Generate a random string.
        $token = openssl_random_pseudo_bytes(8);
    
        //Convert the binary data into hexadecimal representation.
        $token = bin2hex($token);
        $token = mysqli_real_escape_string($conn, $token);
    };

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sqlInsert = "REPLACE into rsvp1 (session,name,email,wish,attend, token)
                   values (?,?,?,?,?,?)";
            $paramType = "isssss";
            $paramArray = array(
                $session,
                $name,
                $email,
                $wish,
                $attend,
                $token
            );
            // $db->insert($sqlInsert, $paramType, $paramArray);
            $status = $db->insert($sqlInsert, $paramType, $paramArray);
            



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
            $mail->msgHTML($email_message);
            //Replace the plain text body with one created manually
            $mail->AltBody = 'This is a plain-text message body';
            //Attach an image file
            // $mail->addAttachment('images/phpmailer_mini.png');
            if(!$status==false && $mail->send()){
                echo 'sent';
            }
}

?>