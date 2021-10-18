<?php 

//check config
include 'config.php';

//Validasi Karakter
function validate($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
  }


// Templating
if(empty(($_GET['t'])))
    { 
        $sesi = ""; 
        $sesi_h = ""; 
        $nama = ""; 
        $readonly = ""; 
    }
else
    { 
        $receiver = $_GET['t'];
        $sqlSelect2 = "SELECT * FROM rsvp1 where token = '$receiver'";
        $result2 = mysqli_query($link,$sqlSelect2);
        if (! empty($result2)) {
            foreach($result2 as $row2){
                $sesi = 'Session ' . $row2['sesi'];
                $nama = $row2['nama'];
            };
        };
        $readonly = "readonly";
        $sesi_array = array(
            "Session 1" => "11.00-12.00 WIB",
            "Session 2" => "12.00-13.00 WIB",
            "Session 3" => "13.00-14.30 WIB",
        );
        $sesi_h = $sesi_array[$sesi];
    };



    

$swap_var = array(
    "{WEDDING_NAME}" => "Firda &amp; Mahendra",
    "{WEDDING_DATE}" => "Saturday, 07 November 2021",
    "{WEDDING_VENUE}" => "Villa Nusantara Syariah, Malang",
    "{WEDDING_LOCATION}" => "Jl. Argobimo No.29, Krajan, Ketindan, Kec. Lawang, Malang, Jawa Timur",
    "{WEDDING_TO}" => $nama,
    "{WEDDING_SESSION}" =>  $sesi,
    "{WEDDING_SESSION_H}" =>  $sesi_h,
    "{WEDDING_PARENTS1}" =>  'Sadfudji Hadijanto & Lelly Asmara Sari',
    "{WEDDING_PARENTS2}" =>  'Darmono & Farida Usman',
    "{ATTR_READONLY}" =>  $readonly,
    
 );

$template = file_get_contents("template.html");
 foreach(array_keys($swap_var) as $key){
    if(strlen($key) > 2 && trim($key) != "")
       $template = str_replace($key, $swap_var[$key], $template);
 }
 echo $template
 ?>