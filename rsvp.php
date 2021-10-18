<?php 
// koneksi database
use Phppot\DataSource;

require_once 'db\DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

if (!empty($_GET['t'])){
    $receiver = $_GET['t'];
    $sqlSelect = "SELECT * FROM rsvp1 where token='$receiver'";
    $result = $db->select($sqlSelect);
        if (! empty($result)) { 
            foreach($result as $row){
            $token = $row['token'];
            };
        }
    }
    else {
    //Generate a random string.
    $token = openssl_random_pseudo_bytes(8);

    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);
    $token = mysqli_real_escape_string($conn, $token);
    }
            

// menangkap data yang di kirim dari form
$name = $_POST['name'];
$email = $_POST['email'];
$wish = $_POST['wish'];
$attend = $_POST['attend'];
$session = substr($_POST['session'], -1);

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
            $db->insert($sqlInsert, $paramType, $paramArray);

}
?>