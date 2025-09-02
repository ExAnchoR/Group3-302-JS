<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Redirect to frontpage if already logged in
    header("Location: frontpage.html");
    exit();
}

$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "database.php"; // Make sure this file correctly establishes $conn

    if ($conn->connect_error) {
        // It's better to show a generic error on the page than die here
        $login_error = "Database connection error. Please try again later.";
        // For debugging: error_log("Database connection failed: " . $conn->connect_error);
    } else {
        if (!isset($_POST['email'], $_POST['password']) || empty(trim($_POST['email'])) || empty(trim($_POST['password']))) {
            $login_error = "Please enter both email and password!";
        } else {
            $email = trim($_POST['email']);
            $password_form = trim($_POST['password']); // Renamed to avoid confusion

            // Modified SQL to fetch fullname
            $stmt = $conn->prepare("SELECT user_id, fullname, email, password FROM users WHERE email = ?");
            if ($stmt === false) {
                $login_error = "Database query error. Please try again.";
                // For debugging: error_log("Prepare failed: " . $conn->error);
            } else {
                $stmt->bind_param("s", $email);

                if (!$stmt->execute()) {
                    $login_error = "Database execution error. Please try again.";
                    // For debugging: error_log("Execute failed: " . $stmt->error);
                } else {
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        // Bind result variables, including fullname
                        $stmt->bind_result($user_id, $db_fullname, $db_email, $hashed_password);
                        $stmt->fetch();

                        if (password_verify($password_form, $hashed_password)) {
                            session_regenerate_id(true);
                            $_SESSION['loggedin'] = true;
                            $_SESSION['email'] = $db_email;
                            $_SESSION['user_id'] = $user_id;
                            $_SESSION['username'] = $db_fullname; // Store fullname in session

                            // Set cookies for frontpage.html
                            $cookie_expiry = time() + (86400 * 30); // 30 days
                            setcookie("isLoggedIn", "true", $cookie_expiry, "/");
                            setcookie("username", trim($db_fullname), $cookie_expiry, "/");

                            // Redirect to frontpage.html on successful login
                            header("Location: frontpage.html");
                            exit();

                        } else {
                            $login_error = "Invalid email or password!";
                        }
                    } else {
                        $login_error = "Invalid email or password!";
                    }
                }
                $stmt->close();
            }
        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(to right, #8D72E1, #e0b7fc);
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .header {
          display: flex;
          align-items: center;
          justify-content: space-between;
          padding: 10px 40px;
          background: linear-gradient(to right, #8D72E1, #6C4AB6);
          border-bottom: 2px solid white;
        }

        .logo-container {
          display: flex;
          align-items: center;
          gap: 10px;
        }

        .logo {
          width: 80px;
          height: auto;
        }

        .title {
          font-size: 50px;
          font-family: fantasy;
          color: white;
          white-space: nowrap;
        }

        .container {
            background: white;
            padding: 30px 40px;
            width: 100%;
            max-width: 400px;
            margin: 100px auto;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #8D72E1;
            border-radius: 50px;
            font-size: 16px;
        }

        button {
            padding: 12px 20px;
            border-radius: 50px;
            border: none;
            background-color: #8D72E1;
            color: white;
            font-size: 18px;
            cursor: pointer;
            width: 90%;
            margin-top: 20px;
        }

        button:hover {
            background-color: #6C4AB6;
        }

        h2 {
            font-size: 36px;
            color: #8D72E1;
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
            font-weight: bold;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
                margin: 60px auto;
                width: 90%;
            }

            h2 {
                font-size: 30px;
            }

            button {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
<div class="header">
    <div class="logo-container">
      <img src="logo.ico" alt="Logo" class="logo" />
      <span class="title">QUIZZLER</span>
    </div>
  </div>
    <div class="container">
        <h2>Login</h2>

        <?php
        if (!empty($login_error)) {
            echo "<p class='error-message'>" . htmlspecialchars($login_error) . "</p>";
        }
        ?>

        <form action="login.php" method="POST"> <!-- Ensure action points to the correct PHP file -->
            <input type="email" name="email" placeholder="Email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <p style="margin-top:15px;">Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
</body>
</html>