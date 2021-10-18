<?php 

use Phppot\DataSource;

require_once 'import\DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

if (!empty($_GET['t'])){
$receiver = $_GET['t'];
$sqlSelect = "SELECT * FROM rsvp1 where token='$receiver'";
$result = $db->select($sqlSelect);
    if (! empty($result)) { 
        foreach($result as $row){
            echo $row['token'];
            echo $row['nama'];
            $sesi = 'Session ' . $row['sesi'];
                    $nama = $row['nama'];
                    $readonly = "readonly";
                    $sesi_array = array(
                        "Session 1" => "11.00-12.00 WIB",
                        "Session 2" => "12.00-13.00 WIB",
                        "Session 3" => "13.00-14.30 WIB",
                    );
                    $sesi_h = $sesi_array[$sesi];
        };

        $readonly = "readonly";
    }
    else
    {
        die('hehehehe');
    };
}
else
{
    
    $sesi = ""; 
    $sesi_h = ""; 
    $nama = ""; 
    $readonly = ""; 
    $receiver = ""; 
};

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
    "{WEDDING_TO}" => $nama,
    "{WEDDING_SESSION}" =>  $sesi,
    "{WEDDING_PARENTS1}" =>  'Sadfudji Hadijanto & Lelly Asmara Sari',
    "{WEDDING_PARENTS2}" =>  'Darmono & Farida Usman',
    "{ATTR_READONLY}" =>  $readonly,
    "{ATTR_SELECT}" =>  $readonly,
    
 );

 //View
$template = file_get_contents("template.html");
 foreach(array_keys($swap_var) as $key){
    if(strlen($key) > 2 && trim($key) != "")
       $template = str_replace($key, $swap_var[$key], $template);
 }
 echo $template
 ?>