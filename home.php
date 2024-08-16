PHP

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
// Display user-specific message. You can customise this part
echo "Welcome, " . $_SESSION['username'] . "!";
// Rest of your script
// You can print whatever you like below or comment them out.
echo "<p>User-generated content: " . htmlspecialchars($user_input) . "</p>";

?>
