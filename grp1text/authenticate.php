<?php
session_start(); // Start the session at the very beginning

// Include your database connection script
// This script MUST successfully establish a mysqli connection
// and make it available, likely in a variable named $conn.
// Example content for database.php is below.
include "database.php";

// Check if the database connection was successful (assuming $conn is the variable from database.php)
if ($conn->connect_error) {
    // Log the error securely in a real application
    die("Database connection failed: " . $conn->connect_error);
}

// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- Basic Input Validation ---
    if (!isset($_POST['email'], $_POST['password']) || empty(trim($_POST['email'])) || empty(trim($_POST['password']))) {
        // Redirect back with an error if fields are empty (using JS alert like your original code)
        echo "<script>alert('Please enter both email and password!'); window.location.href='login.php';</script>";
        exit(); // Stop script execution
    }

    $email = trim($_POST['email']);
    $password = trim($_POST['password']); // The password submitted by the user

    // --- Prepare and Execute Database Query ---
    // Prepare statement to prevent SQL injection
    // Select user_id as well, it's often useful to store in session
    $stmt = $conn->prepare("SELECT user_id, email, password FROM users WHERE email = ?");
    if ($stmt === false) {
        // Handle prepare error - log it securely in a real app
        die("Prepare failed: " . $conn->error);
    }

    // Bind the email parameter
    $stmt->bind_param("s", $email); // "s" means the parameter is a string

    // Execute the query
    if (!$stmt->execute()) {
        // Handle execution error - log it securely
        die("Execute failed: " . $stmt->error);
    }

    // Store the result so we can check num_rows
    $stmt->store_result();

    // --- Check if User Exists and Verify Password ---
    if ($stmt->num_rows > 0) {
        // User found, bind the result variables
        $stmt->bind_result($user_id, $db_email, $hashed_password); // Match the SELECT order

        // Fetch the result
        $stmt->fetch();

        // Verify the password against the hash stored in the database
        // Assumes you used password_hash() when the user signed up
        if (password_verify($password, $hashed_password)) {
            // Password is correct!

            // Regenerate session ID for security (prevents session fixation)
            session_regenerate_id(true);

            // Store user data in session
            $_SESSION['loggedin'] = true; // A flag to easily check if logged in
            $_SESSION['email'] = $db_email; // Store email from DB (or $email, they should match)
            $_SESSION['user_id'] = $user_id; // Store user ID

            // Redirect to the dashboard
            header("Location: dashboard.php");
            exit(); // Important: Stop script execution after redirect

        } else {
            // Incorrect password
            echo "<script>alert('Invalid email or password!'); window.location.href='login.php';</script>";
            exit();
        }
    } else {
        // No user found with that email
        echo "<script>alert('Invalid email or password!'); window.location.href='login.php';</script>";
        exit();
    }

    // Close the statement
    $stmt->close();

} else {
    // If not a POST request, redirect to login (optional, but good practice)
    header("Location: login.php");
    exit();
}

// Close the database connection (optional, PHP often handles this at script end)
$conn->close();

?>