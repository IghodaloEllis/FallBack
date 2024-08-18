<?php
// Database connection
require_once 'database_connection.php'; // Replace with your database connection file

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$email = $_POST['email'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
$fullname = $_POST['fullname'];

// Prepare and execute SQL statement
$sql = "INSERT INTO users (email, username, password, fullname) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $email, $username, $password, $fullname);

if ($stmt->execute()) {
    echo "Registration successful";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
