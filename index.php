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
if(empty(($_GET['to'])))
    { $receiver = ""; }
else
    { $receiver = ucwords($_GET["to"]);};

if(empty(($_GET['s'])))
    { $section = ""; } 
else 
    { $section = "Section ".urlencode($_GET["s"]);};

$section_h = array(
    "Section 1" => "11.00-12.00 WIB",
    "Section 2" => "12.00-13.00 WIB",
    "Section 3" => "13.00-14.30 WIB",
);
$section_prev = $section_h[$section];

$swap_var = array(
    "{WEDDING_NAME}" => "Firda &amp; Mahendra",
    "{WEDDING_DATE}" => "Saturday, 07 November 2021",
    "{WEDDING_VENUE}" => "Villa Nusantara Syariah, Malang",
    "{WEDDING_LOCATION}" => "Jl. Argobimo No.29, Krajan, Ketindan, Kec. Lawang, Malang, Jawa Timur",
    "{WEDDING_TO}" => $receiver,
    "{WEDDING_SECTION}" =>  $section,
    "{WEDDING_SECTION_P}" =>  $section_prev,
    "{WEDDING_PARENTS1}" =>  'Sadfudji Hadijanto & Lelly Asmara Sari',
    "{WEDDING_PARENTS2}" =>  'Darmono & Farida Usman',
    
 );

 //View
$template = file_get_contents("template.html");
 foreach(array_keys($swap_var) as $key){
    if(strlen($key) > 2 && trim($key) != "")
       $template = str_replace($key, $swap_var[$key], $template);
 }
 echo $template
 ?>