<?php

$db['host'] = 'localhost';
$db['user'] = 'root';
$db['pass'] = 'mysql2006';
$db['name'] = 'cms';

// Define constants for database connection
foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

$connection = mysqli_connect("localhost", "root", "mysql2006", "cms");

if($connection) {
    echo "Connection successful";
} else {
    die("Connection failed: " . mysqli_connect_error());
}




?>