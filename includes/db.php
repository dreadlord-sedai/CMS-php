<?php

$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = 'mysql2006';
$db['db_name'] = 'cms';


// Define constants for database connection
foreach($db as $key => $value){
    define(strtoupper($key), $value);
   
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS,DB_NAME);

if($connection) {
    // echo "Connection successful";
} else {
    die("Connection failed: " . mysqli_connect_error());
}




?>