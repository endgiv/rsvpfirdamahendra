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
            if(!$status==false){
                echo 'sent';
            }


}

?>