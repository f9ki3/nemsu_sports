<?php
include 'session.php';
include '../connection.php';

// Check if the connection is successful
if ($conn) {
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $location = isset($_POST['location']) ? mysqli_real_escape_string($conn, $_POST['location']) : '';
    $description = isset($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : '';

    // Insert data into the database
    $query = "INSERT INTO campus (name, location, description) 
              VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $name, $location, $description);

    if ($stmt->execute()) {
        // Redirect or display success message
        echo "<script>alert('Campus added successfully');</script>";
        header("Location: manage_campuses.php?message=1");
        exit();
    } else {
        // Handle errors
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
} else {
    echo "<script>alert('Database connection failed');</script>";
}
?>
