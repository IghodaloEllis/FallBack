<?php
require_once 'database_connection.php'; // Replace with your database connection file

//CHECK IF USER IS LOGGED IN
function isLoggedIn() 
{
    return isset($_SESSION['user_id']);
}
function sendInactiveUserEmail($userId) {
    // Retrieve user information from database
    $query = "SELECT email FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $to = $user['email'];
        $subject = "SCHEDULED 3 YEARS AGO";
        $message = "Dear " . $user['username'] . ",\n\nIf you are seeing this email it means I want you to. Please take your time to read it carefully.\n\nBest regards,\nYour Full name";
        $headers = "From: Your Name <your_email@example.com>";

        if (mail($to, $subject, $message, $headers)) {
            echo "Email sent successfully";
        } else {
            echo "Error sending email";
        }
    } else {
        echo "User not found";
    }
}

// Check for inactive users
$threeYearsAgo = time() - (3 * 365 * 24 * 60 * 60); // Calculate timestamp for 3 years ago

$query = "SELECT id FROM users WHERE last_login < ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $threeYearsAgo);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    sendInactiveUserEmail($row['id']);
}

$conn->close();
?>
