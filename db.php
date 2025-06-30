<?php
$host = 'localhost';
$dbname = 'tegalsari';
$username = 'root'; 
$password = 'root'; 

// Create a connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>