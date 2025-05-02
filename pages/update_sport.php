<?php
include 'session.php';
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the ID and form data
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Update the sports table
    $sql = "UPDATE sports SET name = '$name', description = '$description' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Redirect to manage_sports.php after successful update
        header('Location: manage_sports.php?message=3');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Fetch the sport details if the ID is provided in the query string
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM sports WHERE id = $id");

    if ($result && mysqli_num_rows($result) > 0) {
        $sport = mysqli_fetch_assoc($result);
    } else {
        echo "Sport not found.";
        exit();
    }
}
?>