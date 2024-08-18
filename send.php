<?php
session_start();
require_once 'database_connection.php'; // Replace with your database connection file

function sendInactiveUserEmail($userId) {
  try {
    // Connect to database using PDO (replace with your connection logic)
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
    $stmt->bindValue(":id", $userId, PDO::PARAM_INT); // Use named parameters
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      $to = $user['email'];
      $subject = "Your Account is Inactive";
      $message = "Dear " . $user['username'] . ",\n\nYour account has been inactive for 3 years. Please log in to keep your account active.\n\nBest regards,\nYour Website";
      $headers = "From: Your Name <your_email@example.com>";

      if (mail($to, $subject, $message, $headers)) {
        echo "Email sent successfully";
      } else {
        echo "Error sending email";
      }
    } else {
      echo "User not found";
    }
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  } finally {
    $conn = null; // Close connection (if using PDO)
  }
}

// Check for inactive users
$threeYearsAgo = time() - (3 * 365 * 24 * 60 * 60); // Calculate timestamp for 3 years ago

$query = "SELECT id FROM users WHERE last_login < ?";
$stmt = $conn->prepare($query); // Assuming $conn is defined in your connection script
$stmt->bind_param("i", $threeYearsAgo);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
  sendInactiveUserEmail($row['id']);
}

$conn->close(); // Close connection (if using mysqli)
?>
