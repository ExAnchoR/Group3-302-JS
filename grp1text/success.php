<?php
if (isset($_GET['message'])) {
    echo "<h1>" . htmlspecialchars($_GET['message']) . "</h1>";
} else {
    echo "<h1>No message received.</h1>";
}
?>
