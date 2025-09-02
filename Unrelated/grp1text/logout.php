<?php
session_start(); // Must be called to access and destroy session data

// 1. Unset all of the session variables.
$_SESSION = array();

// 2. If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, // Set expiry in the past
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Finally, destroy the session.
session_destroy();

// 4. Clear the client-side cookies used by frontpage.html JavaScript
// Set their expiry time to the past to instruct the browser to delete them.
setcookie("isLoggedIn", "", time() - 3600, "/"); // "/" for root path
setcookie("username", "", time() - 3600, "/");   // "/" for root pathww
header("Location: frontpage.html"); // Or index.php if that's your true entry point
exit();
?>