<?php
// Database configuration
$db_host = 'localhost'; // Hostname (usually localhost)
$db_user = 'root';      // Default XAMPP MySQL user
$db_pass = '';          // Default XAMPP MySQL password (usually empty)
$db_name = 'uiucos';   // Updated database name

// Create connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
