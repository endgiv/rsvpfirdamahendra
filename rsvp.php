<?php 
// koneksi database
use Phppot\DataSource;

require_once 'import/DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();



// menangkap data yang di kirim dari form
$name = $_POST['name'];
$email = $_POST['email'];
$wish = $_POST['wish'];
$attend = $_POST['attend'];

$sesi = "";
if (isset($_POST['sesi'])) {
$sesi = substr($_POST['sesi'], -1);}

$sesi = "";
if (isset($_POST['sesi'])) {
$sesi = substr($_POST['sesi'], -1);}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //prepare insert
            $sqlInsert = "REPLACE into rsvp1 (sesi,nama,email,wish,attend,token) values (?,?,?,?,?,?)";
            $paramType = "isssss";
            $paramArray = array(
                $sesi,
                $nama,
                $email,
                $wish,
                $attend,
                $token
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);
            
            if (! empty($insertId)) {
                echo 'sent';
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
        
    
?>