<?php 


$session_array = array(
    "1" => "11.00-12.00 WIB",
    "2" => "12.00-13.00 WIB",
    "3" => "13.00-14.30 WIB",
);
$session_h = $session_array[$session];
$swap_var = array(
    "{WEDDING_NAME}" => "Firda &amp; Mahendra",
    "{WEDDING_TO}" => "Endra Aji",
    "{WEDDING_VENUE}" => "<br><b>Villa Nusantara Syariah, Malang</b>",
    "{WEDDING_LOCATION}" => "Jl. Argobimo No.29, Krajan, Ketindan, Kec. Lawang, Malang, Jawa Timur",
    "{WEDDING_ATTEND}" =>"<br><b>Attending</b><br>"."Yes",
    "{WEDDING_SESSION}" =>"<br><b>Saturday, 06 November 2021</b>"."<br>"."11.00-12.00 WIB"
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

?>