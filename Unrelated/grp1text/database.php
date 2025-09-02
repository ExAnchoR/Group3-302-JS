<?php
$servername = "localhost"; // Usually correct for XAMPP
$username = "root";        // Default XAMPP username (use a dedicated user in production)
$password = "";            // Default XAMPP password (set a password in production)
$dbname = "dbaccounts";    // <--- Changed to match your signup script's database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Use json_encode or log errors properly in production instead of die()
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set character set (good practice)
if (!$conn->set_charset("utf8mb4")) {
    // Handle error if needed, but don't necessarily stop the script
    // printf("Error loading character set utf8mb4: %s\n", $conn->error);
}

// The $conn variable is now ready for use in scripts that include this file.
?>