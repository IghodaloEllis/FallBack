<?php
require_once 'database_connection.php'; // Replace with your database connection file
session_start();

// Get user input
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and execute SQL statement
$sql = "SELECT password FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Successful login, redirect to dashboard or other page
        header("Location: send.php");
        exit;
    } else {
        echo "Incorrect password";
    }
} else {
    echo "User not found";
}

$stmt->close();
$conn->close();
?>
