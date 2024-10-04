<?php
$db_host = 'localhost';
$db_user = 'username'; // Replace with the actual username
$db_pass = '';  // Use the actual password (remove any spaces)
$db_name = 'onlinevotingsystem'; // Ensure this matches your database name

// Create connection
$db = mysqli_connect('localhost', 'root', '', 'onlinevotingsystem');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}
?>

