<?php
include 'session.php';
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the ID and form data
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Update the campuses table
    $sql = "UPDATE campus SET name = '$name', location = '$location', description = '$description' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Redirect to manage_campuses.php after successful update
        header('Location: manage_campuses.php?message=3');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Fetch the campus details if the ID is provided in the query string
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM campuses WHERE id = $id");

    if ($result && mysqli_num_rows($result) > 0) {
        $campus = mysqli_fetch_assoc($result);
    } else {
        echo "Campus not found.";
        exit();
    }
}
?>