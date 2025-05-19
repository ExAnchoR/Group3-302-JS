<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "dbaccounts"; // Use the same database as signup.php

$connection = mysqli_connect($server, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
