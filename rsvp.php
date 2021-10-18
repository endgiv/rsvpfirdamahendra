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
<<<<<<< HEAD
<<<<<<< HEAD
        $sql = "REPLACE INTO rsvp1 (name, email, wish, attend, sesi) VALUES (?, ?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            //bind var
            mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $wish, $attend, $sesi);
=======
        $sql = "INSERT INTO rsvp (name, email, wish, attend, sesi) VALUES (?, ?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            //bind var
            mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $wish, $attend, $sesi);
>>>>>>> parent of 9ee4c8f (last)
=======
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
>>>>>>> parent of 87b6967 (last)
            
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