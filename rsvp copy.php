<?php 
// koneksi database
include 'config.php';


// menangkap data yang di kirim dari form
$name = $_POST['name'];
$email = $_POST['email'];
$wish = $_POST['wish'];
$attend = $_POST['attend'];
$sesi = substr($_POST['sesi'], -1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //prepare insert
        $sql = "INSERT INTO rsvp1 (name, email, wish, attend, sesi) VALUES (?, ?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            //bind var
            mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $wish, $attend, $sesi);
            
            //
            if(mysqli_stmt_execute($stmt)){
                //redirect
                echo 'sent';
            } else {
                echo "Kayaknya ada yang salah";
            }
        }
        
    }
?>