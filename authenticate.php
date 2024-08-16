### Authentication Script (authenticate.php)

```php
<?php
session_start();

require_once 'database_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();  
  $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location:  

 home.php"); // Replace with your home page
        exit;
    } else {
        // Handle login failure
        echo "Invalid email or password";
    }
}
?>

