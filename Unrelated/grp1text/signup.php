<?php
// START SESSION AT THE VERY TOP
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username_db = "root"; // Renamed to avoid conflict with form field
$password_db = "";   // Renamed to avoid conflict with form field
$dbname = "dbaccounts";

$signup_message = ""; // Variable to hold signup messages for HTML display
$signup_success = false;

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    $signup_message = "Database connection failed. Please try again later.";
    // For debugging: error_log("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && $conn && !$conn->connect_error) {
    $fullname_form = trim($_POST["fullname"]); // Renamed to be explicit
    $email_form = trim($_POST["email"]);       // Renamed
    $password_form = trim($_POST["password"]); // Renamed

    if (empty($fullname_form) || empty($email_form) || empty($password_form)) {
        $signup_message = "All fields are required.";
    } else if (!filter_var($email_form, FILTER_VALIDATE_EMAIL)) {
        $signup_message = "Invalid email format.";
    } else {
        // Check if email exists
        $stmt_check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        if ($stmt_check) {
            $stmt_check->bind_param("s", $email_form);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();

            if ($result_check->num_rows > 0) {
                $signup_message = "Email already exists.";
            } else {
                // Hash the password before storing
                $hashedPassword = password_hash($password_form, PASSWORD_DEFAULT);

                // Insert the new user
                $stmt_insert = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
                if ($stmt_insert) {
                    $stmt_insert->bind_param("sss", $fullname_form, $email_form, $hashedPassword);

                    if ($stmt_insert->execute()) {
                        $new_user_id = $stmt_insert->insert_id; // Get ID of the newly inserted user

                        // Auto-login the user
                        session_regenerate_id(true);
                        $_SESSION['loggedin'] = true;
                        $_SESSION['email'] = $email_form;
                        $_SESSION['user_id'] = $new_user_id;
                        $_SESSION['username'] = $fullname_form;

                        // Set cookies for frontpage.html
                        $cookie_expiry = time() + (86400 * 30); // 30 days
                        setcookie("isLoggedIn", "true", $cookie_expiry, "/");
                        setcookie("username", trim($fullname_form), $cookie_expiry, "/");

                        // Redirect to frontpage.html
                        header("Location: frontpage.html");
                        exit();

                    } else {
                        $signup_message = "Error during signup. Please try again.";
                        // For debugging: error_log("Signup insert execute error: " . $stmt_insert->error);
                    }
                    $stmt_insert->close();
                } else {
                    $signup_message = "Database error (prepare insert). Please try again.";
                    // For debugging: error_log("Signup insert prepare error: " . $conn->error);
                }
            }
            $stmt_check->close();
        } else {
            $signup_message = "Database error (prepare check). Please try again.";
            // For debugging: error_log("Signup check prepare error: " . $conn->error);
        }
    }
}

if ($conn && !$conn->connect_error) {
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        /* General reset for margin and padding */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: linear-gradient(to right, #8D72E1, #e0b7fc);
            text-align: center; font-family: Arial, sans-serif;
        }
        .container {
            background: white; padding: 30px 40px; width: 100%;
            max-width: 400px; margin: 100px auto; border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        input {
            width: 90%; padding: 12px; margin: 10px 0;
            border: 2px solid #8D72E1; border-radius: 50px; font-size: 16px;
        }
        button {
            padding: 12px 20px; border-radius: 50px; border: none;
            background-color: #8D72E1; color: white; font-size: 18px;
            cursor: pointer; width: 90%; margin-top: 20px;
        }
        button:hover { background-color: #6C4AB6; }
        h2 { font-size: 36px; color: #8D72E1; margin-bottom: 20px; }
        .message { margin-bottom: 15px; font-weight: bold; }
        .message.error { color: red; }
        .message.success { color: green; } /* Not used if redirecting, but good practice */
        @media (max-width: 600px) {
            .container { padding: 20px; margin: 60px auto; width: 90%; }
            h2 { font-size: 30px; }
            button { font-size: 16px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sign up</h2>
        <?php
        if (!empty($signup_message)) {
            // Determine class based on success (though we redirect on success here)
            $message_class = $signup_success ? 'success' : 'error';
            echo "<p class='message " . $message_class . "'>" . htmlspecialchars($signup_message) . "</p>";
        }
        ?>
        <form action="signup.php" method="POST">
            <input type="text" name="fullname" placeholder="Full Name" required value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>"><br>
            <input type="email" name="email" placeholder="Email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Signup</button>
        </form>
        <p style="margin-top:15px;">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>