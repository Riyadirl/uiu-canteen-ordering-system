<?php
// Include the database configuration file
include('../config/config.php');

// Check the connection
if ($conn) {
    echo "Database connection successful!";
} else {
    echo "Database connection failed: " . mysqli_connect_error();
}

// Close the connection
mysqli_close($conn);
