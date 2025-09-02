<?php
include "database.php";

$email = "test@example.com";
$password = password_hash("password123", PASSWORD_DEFAULT);


$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    echo "Test user added successfully!";
} else {
    echo "User already exists!";
}
?>
