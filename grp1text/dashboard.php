<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            background-color: #E6E6FA;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            background: white;
            padding: 20px;
            width: 300px;
            margin: 100px auto;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        a {
            background-color: #9370DB;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($email); ?>!</h2>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
