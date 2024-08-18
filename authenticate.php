### Authentication Script (authenticate.php)

<?php
session_start();

require_once 'database_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'];

  // Prepare and execute the query
  $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    // Regenerate session ID
    session_regenerate_id(true);
    header("Location: home.php"); // Replace with your home page
    exit;
  } else {
    // Handle login failure with appropriate error message
    header("Location: index.php"); // Replace with your home page
    // Consider implementing rate limiting here
  }
}
?>
?>

