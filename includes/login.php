<?php
include "db.php";
?>

<?php

if(isset($_POST['login'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];

   // clean mysql
   $username = mysqli_real_escape_string($connection, $username);
   $password = mysqli_real_escape_string($connection, $password);

   $query = "SELECT * FROM WHERE usrname = '{$username}'";
   $select_user_query = mysqli_query($connection, $query);
   if(!$select_user_query) {
    die("QUERY FAILED!". mysqli_error($connection));
   }
}

?>