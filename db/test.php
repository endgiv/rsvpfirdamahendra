<?php 
use Phppot\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();


if (!empty($_GET['t'])){
$receiver = $_GET['t'];
$sqlSelect = "SELECT * FROM rsvp1 where token='$receiver'";
$result = $db->select($sqlSelect);
if (! empty($result)) { 
    echo 'hehe <br>';
    foreach($result as $row){
        echo $row['token'];
    };
}
else {
    die('hehehehe');
};
}
else {
    die('aha');
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>