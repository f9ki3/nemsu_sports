<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to the dashboard or home page
    header("Location: ./pages/dashboard.php");
    exit();
}
?>