<?php
session_start();
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Prepare and execute query
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            // Directly compare plain text passwords
            if ($password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];

                // Redirect on success
                header("Location: ./pages/dashboard.php");
                exit();
            } else {
                $_SESSION['error'] = "Invalid username or password.";
            }
        } else {
            $_SESSION['error'] = "Invalid username or password.";
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Please fill in all fields.";
    }

    // Redirect back to login on error with a query string variable
    header("Location: ./?error=1");
    exit();
}
?>
