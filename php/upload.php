<?php
// post handling
$charname = $_POST["namechar"];
$fileName = $_FILES['saveFile']['name'];
$gamepass = $_POST["gamepass"];
$tempName = $_FILES['saveFile']['tmp_name'];

// Move file to this directory
$dirUpload = "terupload/";
$terupload = move_uploaded_file($tempName, $dirUpload . $fileName);
$b = "./" . $dirUpload . $fileName; // now $b contains full path of uploaded files

if ($terupload) {
    echo "LOG: <br>Upload Success!<br>Fullpath :";
    echo $b;
    $data = file_get_contents($b);

    $db = pg_connect("host=127.0.0.1 port=5432 dbname=erupe user=samboge password=gampang1");
    $result = pg_query($db, "SELECT username,password from users where id = $charname");
    if (!$result) {
        echo "An error occurred.\n";
        exit;
    }
    while ($row = pg_fetch_row($result)) {
        //echo "Author: $row[0]";
        $pass = $row[1];
        echo "<br />\n";
    }
    if (password_verify($gamepass, $pass)) {
        echo '<h1>Password is valid!';
        $escaped = pg_escape_bytea($data); //read bin files
        $result = pg_query($db, "UPDATE characters set savedata = '{$escaped}' where id = $charname");
        if (!$result) {
            echo "<br>error update savedata";
        } else {
            while ($row = pg_fetch_row($result)) {
                echo "<br />\n";
            }
            echo "process done probably</h1>";
        }
    } else {
        echo '<h1>Invalid password. import failed</h1>';
    }
} else {
    echo "<h1>Upload Failed!</h1>";
}
unlink($b);
?>