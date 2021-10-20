<?php 

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
            echo $row['token'];
            echo $row['name'];
            $session = 'Session ' . $row['session'];
                    $name = $row['name'];
                    $readonly = "readonly";
                    $session_array = array(
                        "Session 1" => "11.00-12.00 WIB",
                        "Session 2" => "12.00-13.00 WIB",
                        "Session 3" => "13.00-14.30 WIB",
                    );
                    $session_h = $session_array[$session];
        };
        $session_f = $session." - ".$session_h;
        $readonly = "readonly";
    }
    else
    {
        die('hehehehe');
    };
}
else
{
    
    $session = ""; 
    $session_h = ""; 
    $session_f = "Session 1 - 11.00-12.00 WIB <br> Session 2 : 12.00-13.00 WIB <br> Session 3 : 13.00-14.30 WIB"; 
    $name = ""; 
    $readonly = ""; 
    $receiver = ""; 
};

$wishes ='';
$sqlSelect1 = "SELECT * FROM rsvp1 where wish <>''";
$result1 = $db->select($sqlSelect1);
    if (! empty($result1)) { 
        foreach($result1 as $wish) {
        $wishes .= '<div><span class="text-white mb-0">'.$wish['name'].'</span>  <span class="text-light mb-0">'.$wish['wish'].'</span></div>';
        };
    };

$swap_var = array(
    "{WEDDING_NAME}" => "Firda &amp; Mahendra",
    "{WEDDING_DATE}" => "Saturday 07 November 2021",
    "{WEDDING_HOUR}" => $session_f,
    "{WEDDING_VENUE}" => "Villa Nusantara Syariah, Malang",
    "{WEDDING_LOCATION}" => "Jl. Argobimo No.29, Krajan, Ketindan, Kec. Lawang, Malang, Jawa Timur",
    "{WEDDING_TO}" => $name,
    "{WEDDING_SESSION}" =>  $session,
    "{WEDDING_SESSION_H}" =>  $session_h,
    "{WEDDING_PARENTS1}" =>  'Sadfudji Hadijanto & Lelly Asmara Sari',
    "{WEDDING_PARENTS2}" =>  'Darmono & Farida Usman',
    "{WEDDING_WISHES}" =>  $wishes,
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