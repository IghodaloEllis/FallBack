<?php
// Database credentials (consider using environment variables or configuration files)
$host = 'your_host';
$dbname = 'your_database';
$username = 'your_username';
$password = 'your_password';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Error handling
  // Additional configuration options (e.g., encryption)
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}
