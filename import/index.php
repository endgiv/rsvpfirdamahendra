<?php
use Phppot\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();



if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            
            $sesi = "";
            if (isset($column[0])) {
                $sesi = mysqli_real_escape_string($conn, $column[0]);
            }
            $nama = "";
            if (isset($column[1])) {
                $nama = mysqli_real_escape_string($conn, $column[1]);
            }
            $email = "";
            if (isset($column[2])) {
                $email = mysqli_real_escape_string($conn, $column[2]);
            }
            $wish = "";
            if (isset($column[3])) {
                $wish = mysqli_real_escape_string($conn, $column[3]);
            }
            $attend = "";
            if (isset($column[4])) {
                $attend = mysqli_real_escape_string($conn, $column[4]);
            }

            $token = "";
            if (isset($token)) {
                //Generate a random string.
                $token = openssl_random_pseudo_bytes(8);

                //Convert the binary data into hexadecimal representation.
                $token = bin2hex($token);
                $token = mysqli_real_escape_string($conn, $token);
            }
            
            $sqlInsert = "REPLACE into rsvp1 (sesi,nama,email,wish,attend, token)
                   values (?,?,?,?,?,?)";
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
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
<script src="jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</head>

<body>
    <h2>Import CSV file into Mysql using PHP</h2>

    <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
        </div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        </div>
               <?php
            $sqlSelect = "SELECT * FROM rsvp1";
            $result = $db->select($sqlSelect);
            if (! empty($result)) {
                ?>
            <table id='userTable'>
            <thead>
                <tr>
                    <th>Sesi</th>
                    <th>Nama</th>
                    <th>Wish</th>
                    <th>Attend</th>
                    <th>Token</th>
                    <th>Link</th>
                    <th>Created Date</th>

                </tr>
            </thead>
<?php
                
                foreach ($result as $row) {
                    ?>
                    
                <tbody>
                <tr>
                    <td><?php  echo $row['sesi']; ?></td>
                    <td><?php  echo $row['nama']; ?></td>
                    <td><?php  echo $row['wish']; ?></td>
                    <td><?php  echo $row['attend']; ?></td>
                    <td><?php  echo $row['token']; ?></td>
                    <td><a href="<?php  echo 'http://localhost:8012/rsvpfirdamahendra/?t=' . $row['token']; ?>">Link</a></td>
                    <td><?php  echo $row['create_date']; ?></td>
                </tr>
                    <?php
                }
                ?>
                </tbody>
        </table>
        <?php } ?>
    </div>

</body>

</html>