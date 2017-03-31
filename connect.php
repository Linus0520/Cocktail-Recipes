<?php

//ENTER YOUR DATABASE CONNECTION INFO BELOW:
$host_name  = "db674453308.db.1and1.com";
$database   = "db674453308";
$user_name  = "dbo674453308";
$password   = "Woaixiaotu520@";

//DO NOT EDIT BELOW THIS LINE
$link = mysqli_connect($hostname, $username, $password);
if (!$link) {
die('Connection failed: ' . mysqli_error());
}
else{
     echo "Connection to MySQL server " .$hostname . " successful!
" . PHP_EOL;
}

$db_selected = mysqli_select_db($database, $link);
if (!$db_selected) {
    die ('Can\'t select database: ' . mysqli_error());
}
else {
    echo 'Database ' . $database . ' successfully selected!';
}

mysqli_close($link);

?>