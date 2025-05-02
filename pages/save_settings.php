<?php
include 'session.php';
include '../connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $eventName = $_POST['eventName'];
    $location = $_POST['location'];
    $organizerName = $_POST['organizerName'];

    // Update query
    $sql = "UPDATE settings SET event_name = ?, location = ?, organizer_name = ? WHERE id = 1"; // Assuming id = 1 for a single settings row
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $eventName, $location, $organizerName);

    if ($stmt->execute()) {
        echo "Settings updated successfully.";
        header("Location: settings.php?message=1");
        exit();
    } else {
        echo "Error updating settings: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
